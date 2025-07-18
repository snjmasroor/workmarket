<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tool;
use Yajra\DataTables\DataTables;

class ToolController extends Controller
{

    public function index() {
        return view('admin.tools.index');
    }

    public function data()
    {
        return DataTables::of(Tool::query()->orderBy('id', 'desc'))
        ->addColumn('price', function ($row) {
           return '$' . number_format($row->price, 2);
        })
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
            $editUrl = route('admin.tools.edit', $row->id);
            $deleteUrl = route('admin.tools.destroy', $row->id);
            return '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="'.$editUrl.'">
                    <i class="ti ti-pencil me-1"></i> Edit
                </a>
                <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this Tool?\');">
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
        return view('admin.tools.create');
    }

    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'verification_method' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Manually assign values
        $tool = new Tool();
        $tool->name = $validated['name'];
        $tool->description = $validated['description'] ?? null;
        $tool->type = $validated['type'] ?? null;
        $tool->model = $validated['model'] ?? null;
        $tool->verification_method = $validated['verification_method'] ?? null;
        $tool->price = $validated['price'] ?? null;
        
        $tool->addFlag(Tool::FLAG_ACTIVE);

        // Save to database
        $tool->save();

        // Redirect or respond
        return redirect()->route('admin.tools.index')->with('success', 'Tool created successfully.');
    }

    public function edit(Tool $tool)
    {
        return view('admin.tools.edit', compact('tool'));
    }

    public function update(Request $request, Tool $tool)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'nullable|string|max:255',
            'model' => 'nullable|string|max:255',
            'verification_method' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
        ]);

        // Update values
        $tool->name = $validated['name'];
        $tool->description = $validated['description'] ?? null;
        $tool->type = $validated['type'] ?? null;
        $tool->model = $validated['model'] ?? null;
        $tool->verification_method = $validated['verification_method'] ?? null;
        $tool->price = $validated['price'] ?? null;

        if ($request->status == true) {
            $tool->addFlag(Tool::FLAG_ACTIVE);
        }
        // Save to DB
        $tool->save();

        return redirect()->route('admin.tools.index')->with('success', 'Tool updated successfully.');
    }

    public function destroy(Tool $tool)
    {
        try {
            $tool->delete();

            return redirect()
                ->route('admin.tools.index')
                ->with('success', 'Tool deleted successfully.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Failed to delete the tool. Please try again.');
        }
    }


    public function getTool(Request $request)
    {
        $perPage = $request->input('per_page', 10); // Default to 10 if not provided

        $tools = Tool::select('id', 'name')->paginate($perPage);

        return response()->json($tools);
    }
}
