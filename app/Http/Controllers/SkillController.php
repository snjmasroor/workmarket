<?php

namespace App\Http\Controllers;
use App\Models\Skill;
use Yajra\DataTables\DataTables;


use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function index() {
        // $skills = Skill::all();   
        return view('admin.skills.show-skill');
    }

    public function data(Request $request)
    {
        
        return DataTables::of(Skill::query()->orderByDesc('id'))
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
                $editUrl = route('admin.skill.edit', $row->id);
                $deleteUrl = route('admin.industries.destroy', $row->id);

                return '
                    <a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>
                ';
            })
            ->rawColumns(['flags', 'action']) // allow HTML rendering
            ->make(true);
    }
    public function create () {
        return view('admin.skills.skill-create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:skills,name',
            'active' => 'nullable',
        ]);

        $skill = new Skill;
        $skill->name = $request->name;

        if ($request->filled('active') && $request->active == true) {
            $skill->addFlag(Skill::FLAG_ACTIVE);
        }
        if (!$skill->save()) {
            return back()->with('error', 'skill created successfully.');
        }
            return back()->with('success', 'skill created successfully.');
       
    }

    public function edit(Request $request, $id) {
     $skill = Skill::where('id', $id)->first();
        return view('admin.skills.skill-edit', compact('skill'));
    }

    public function update (Request $request, $id) {
      $validated = $request->validate([
            'name' => 'required|string|max:255',
            'active' => 'required|in:0,1',
        ]);

        try {
            // Step 2: Find the skill or fail
            $skill = Skill::findOrFail($id);

            // Step 3: Update skill flags and data
            $skill->removeFlag(Skill::FLAG_ACTIVE);

            $skill->name = $validated['name'];

            if ($request->filled('active') && $validated['active'] == true) {
                $skill->addFlag(Skill::FLAG_ACTIVE);
            }

            $skill->save();

            // Step 4: Redirect with success message
            return redirect()->route('show.skills')->with('success', 'Skill updated successfully.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Specific error if skill not found
            return redirect()->back()->with('error', 'Skill not found.');
            
        } catch (\Exception $e) {
            // General exception handler
            return redirect()->back()->with('error', 'An error occurred while updating the skill.');
        }
    }
}
