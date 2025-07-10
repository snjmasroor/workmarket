<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Tests;

class TestsController extends Controller
{
    public function index() {
        return view('admin.tests.index');
    }

    public function data()
    {
        return DataTables::of(Tests::query()->orderBy('id', 'desc'))
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
            $editUrl = route('admin.tests.edit', $row->id);
            $questionsUrl = route('admin.tests.add_question', $row->id);
            $deleteUrl = route('admin.tests.destroy', $row->id);
            return '<div class="dropdown">
            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                <i class="ti ti-dots-vertical"></i>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="'.$editUrl.'">
                    <i class="ti ti-pencil me-1"></i> Edit
                </a>
                <a class="dropdown-item" href="'.$questionsUrl.'">
                    <i class="ti ti-pencil me-1"></i> Create Questions
                </a>
                <form action="'.$deleteUrl.'" method="POST" onsubmit="return confirm(\'Are you sure you want to delete this test?\');">
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
        return view('admin.tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'nullable|integer|min:1',
            'duration_minutes' => 'required|integer|min:1',
        ]);

        $test = new Tests();
        $test->title = $request->title;
        $test->description = $request->description;
        $test->passing_score = $request->passing_score;
        $test->max_attempts = $request->max_attempts;
        $test->duration_minutes = $request->duration_minutes;
        $test->test_type = $request->test_type;
        if ($request->status == true) {
            $test->addFlag(Tests::FLAG_ACTIVE);
        }
        $test->save();

        return redirect()->route('admin.tests.show')->with('success', 'Test created successfully!');
    }

    public function edit(Tests $test)
    {   
        return view('admin.tests.edit', compact('test'));
    }

    public function update(Request $request, Tests $test)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'passing_score' => 'required|integer|min:0|max:100',
            'max_attempts' => 'nullable|integer|min:1',
            'duration_minutes' => 'required|integer|min:1',
            'test_type' => 'required|string',
        ]);

        $test->title = $request->title;
        $test->description = $request->description;
        $test->passing_score = $request->passing_score;
        $test->max_attempts = $request->max_attempts;
        $test->duration_minutes = $request->duration_minutes;
        $test->test_type = $request->test_type;
        $test->removeFlag(Tests::FLAG_ACTIVE);
        if ($request->status == true) {
            $test->addFlag(Tests::FLAG_ACTIVE);
        }
        $test->save();

        return redirect()->route('admin.tests.show')->with('success', 'Test updated successfully!');
    }

    public function destroy(Tests $test)
    {
        $test->delete(); // soft delete
        return back()->with('success', 'Test deleted successfully.');
    }
}
