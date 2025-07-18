<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certification;
use Yajra\DataTables\DataTables;
class CertificationController extends Controller
{
    public function index() {
        return view('admin.certificates.index');
    }

    public function data()
    {
        return DataTables::of(Certification::query()->orderBy('id', 'desc'))
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
            $editUrl = route('admin.certificates.edit', $row->id);
            $deleteUrl = route('admin.certificates.destroy', $row->id);
            return '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="'.$editUrl.'">
                    <i class="ti ti-pencil me-1"></i> Edit
                </a>
                <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this certificate?\');">
                    '.csrf_field().method_field('DELETE').'
                    <button type="submit" class="dropdown-item text-danger">
                        <i class="ti ti-trash me-1"></i> Delete
                    </button>
                </form>
            </div>
        </div>';
        })
        ->rawColumns(['flags', 'action']) // allow HTML rendering
        ->make(true);
    }

    public function create() {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        // Validate incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'certification_level' => 'nullable|string|max:255',
            'validity_period' => 'nullable|string|max:255',
            'expiration_date' => 'nullable|date',
            'verification_method' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            // Store the certificate
            $certificate = new Certification();
            $certificate->name = $validated['name'];
            $certificate->issuing_organization = $validated['issuing_organization'];
            $certificate->certification_level = $validated['certification_level'] ?? null;
            $certificate->validity_period = $validated['validity_period'] ?? null;
            $certificate->expiration_date = $validated['expiration_date'] ?? null;
            $certificate->verification_method = $validated['verification_method'] ?? null;
            $certificate->description = $validated['description'] ?? null;

            $certificate->addFlag(Certification::FLAG_ACTIVE);


            // Save to DB
            $certificate->save();

            return redirect()->route('admin.certificates.index')
                            ->with('success', 'Certificate added successfully.');

        } catch (\Exception $e) {
            \Log::error('Certificate creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->withInput()
                        ->with('error', 'Failed to create certificate. Please try again.');
        }
    }

    public function edit(Certification $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certification $certificate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'certification_level' => 'nullable|string|max:255',
            'validity_period' => 'nullable|string|max:255',
            'expiration_date' => 'nullable|date',
            'verification_method' => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        $certificate->name = $validated['name'];
        $certificate->issuing_organization = $validated['issuing_organization'];
        $certificate->certification_level = $validated['certification_level'] ?? null;
        $certificate->validity_period = $validated['validity_period'] ?? null;
        $certificate->expiration_date = $validated['expiration_date'] ?? null;
        $certificate->verification_method = $validated['verification_method'] ?? null;
        $certificate->description = $validated['description'] ?? null;
        $certificate->removeFlag(Certification::FLAG_ACTIVE);
        if ($request->status == true) {
            $certificate->addFlag(Certification::FLAG_ACTIVE);
        }
        $certificate->save();

        return redirect()
            ->route('admin.certificates.index')
            ->with('success', 'Certificate updated successfully.');
    }

    public function getCertification(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 if not provided

        $certifications = Certification::select('id', 'name')->paginate($perPage);

        return response()->json($certifications);
    }

    public function destroy(Certification $certificate)
    {
        try {
            $certificate->delete();

            return redirect()
                ->route('admin.certificates.index')
                ->with('success', 'Certificate deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete the certificate. Please try again.');
        }
    }
}
