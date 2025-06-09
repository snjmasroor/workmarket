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

            return '
                <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
            ';
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
            return redirect()->route('show.industry')->with('error', 'Industry created successfully.');
        }else {
            return redirect()->route('show.industry')->with('success', 'Industry created successfully.');

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
    return redirect()->route('show.industry')->with('success', 'Industry updated successfully.');
}

    
}
