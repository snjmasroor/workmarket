<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use Yajra\DataTables\DataTables;

class IndusrtyController extends Controller
{
    
    public function index() {
        // $industries = Industry::all();
        // dd($industries);
        
        return view('admin.show-industries');
    }


public function data(Request $request)
{
    return DataTables::of(Industry::query())
        ->addColumn('flags', function ($row) {
            if ($row->active === true || $row->active == 1) {
                return '<span class="badge bg-label-success me-1">Active</span>';
            } elseif ($row->active === false || $row->active == 0) {
                return '<span class="badge bg-label-warning me-1">Inactive</span>';
            } else {
                return '<span class="badge bg-secondary">None</span>';
            }
        })
        ->addColumn('action', function ($row) {
            $editUrl = route('admin.industries.edit', $row->id);
            $deleteUrl = route('admin.industries.destroy', $row->id);
            return '<div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="'.$editUrl.'"
                                ><i class="ti ti-pencil me-1"></i> Edit</a
                              >
                              <a class="dropdown-item" href="javascript:void(0);"
                                ><i class="ti ti-trash me-1"></i> Delete</a
                              >
                            </div>
                          </div>';
        })
        ->rawColumns(['flags', 'action']) // allow HTML rendering
        ->make(true);
}

public function create () {
    return view('admin.industry.industry-create');
}

public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:industries,name',
            'active' => 'nullable',
        ]);

        

        $industry = new Industry;
        $industry->name = $request->name;

        if ($request->filled('active') && $request->active == true) {
            $industry->addFlag(Industry::FLAG_ACTIVE);
        }
        if (!$industry->save()) {
            return redirect()->route('admin.industries.show')->with('error', 'Industry created successfully.');
        }else {
            return redirect()->route('admin.industries.show')->with('success', 'Industry created successfully.');

        }

       
}

public function edit(Request $request, $id) {
     $industry = Industry::where('id', $id)->first();
    return view('admin.industry.industry-edit', compact('industry'));
}

public function update (Request $request, $id) {
     $request->validate([
        'name' => 'required|string|max:255',
        'active' => 'required|in:0,1',
    ]);

    // Find the existing industry
    $industry = Industry::findOrFail($id);
    $industry->removeFlag(Industry::FLAG_ACTIVE);
    // Update the data
    $industry->name = $request->input('name');
    if ($request->filled('active') && $request->active == true) {
        $industry->addFlag(Industry::FLAG_ACTIVE);
    }
    
    $industry->save();

    // Redirect back with success message
    return redirect()->route('admin.industries.show')->with('success', 'Industry updated successfully.');
}

    
}
