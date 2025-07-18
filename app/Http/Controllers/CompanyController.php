<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Industry;
use Yajra\DataTables\DataTables;
use Auth;

class CompanyController extends Controller
{

    public function show()
    {
        $company = Company::where('admin_id', auth()->id())->first();

        if (!$company) {
            return redirect()->route('admin.dashboard')->with('error', 'Company not found.');
        }

        return view('admin.company.show', compact('company'));
    }
    public function create()
    {
        // $company = Company::where('admin_id', auth()->id())->first();
        $industries = Industry::whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();
        return view('admin.company.create', compact('industries'));
    }

    public function data(Request $request)
    {
        return DataTables::of(Company::query()->with('industry', 'admin'))
            ->addColumn('flags', function ($row) {
                if ($row->active === true || $row->active == 1) {
                    return '<span class="badge bg-label-success me-1">Active</span>';
                } elseif ($row->active === false || $row->active == 0) {
                    return '<span class="badge bg-label-warning me-1">Inactive</span>';
                } else {
                    return '<span class="badge bg-secondary">None</span>';
                }
            })
              ->addColumn('industry_name', function ($row) {
                    return $row->industry->name ?? 'N/A';
                })
            ->addColumn('admin_name', function ($row) {
                  return $row->admin->name ?? '—';
               
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.company.edit', $row->id);
                return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.$editUrl.'"
                                ><i class="ti ti-pencil me-1"></i> Edit</a
                            >
                            </div>
                        </div>';
            })
            ->rawColumns(['flags', 'action']) // allow HTML rendering
            ->make(true);
    }

    public function store(Request $request)
    {
        $request->validate([
        'name'        => 'required|string|max:255',
        'industry_id' => 'required|exists:industries,id',
        'description' => 'nullable|string',
        ]);
        if (Company::where('admin_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You already have a company.');
        }

        $company = new Company();
        $company->admin_id = auth()->id();
        $company->name = $request->name;
        $company->industry_id = $request->industry_id;
        $company->description = $request->description;
        $company->addFlag(Company::FLAG_ACTIVE);
        if ($request->hasFile('logo')) {
            $company->logo = $request->file('logo')->store('logos', 'public');
        }

        $company->save();

        return redirect()->back()->with('success', 'Company created successfully.');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $industries = Industry::all();

        return view('admin.company.edit', compact('company', 'industries'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'industry_id' => 'required|exists:industries,id',
            'description' => 'nullable|string',
        ]);

        $company = Company::findOrFail($id);

        $company->name        = $request->name;
        $company->industry_id = $request->industry_id;
        $company->description = $request->description;
        $company->removeFlag(Company::FLAG_ACTIVE);

        if($request->status == true) {
            $company->addFlag(Company::FLAG_ACTIVE);
        }
        if ($request->hasFile('logo')) {
            // Optional: delete old logo
            if ($company->logo && \Storage::disk('public')->exists($company->logo)) {
                \Storage::disk('public')->delete($company->logo);
            }

            $company->logo = $request->file('logo')->store('logos', 'public');
        }

        $company->save();

        return redirect()->route('admin.company.show')->with('success', 'Company updated successfully.');
    }

}
