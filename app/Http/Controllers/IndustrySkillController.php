<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\IndustrySkill;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class IndustrySkillController extends Controller
{
   public function index() {
        $industry_skills = Industry::with('skills')->get();  
        return view('admin.industry-skill.is-index', compact('industry_skills'));
    }

    public function data()
    {
        $industries = Industry::with('skills')->get();

    return DataTables::of($industries)
        ->addColumn('skill_names', function ($industry) {
            if ($industry->skills->isEmpty()) {
                return '<span class="text-muted">No skills</span>';
            }

            return $industry->skills->map(function ($skill) {
                return '<span class="badge bg-info me-1">' . e($skill->name) . '</span>';
            })->implode(' ');
        })
        ->addColumn('action', function ($industry) {
            $editUrl = route('admin.industries.edit', $industry->id);
            return '<a href="' . $editUrl . '" class="btn btn-sm btn-primary">Edit</a>';
        })
        ->rawColumns(['skill_names', 'action'])
        ->make(true);
    }

    public function getSkills() {
        $skills = Skill::whereRaw('`flags` & ? = ?', [Skill::FLAG_ACTIVE, Skill::FLAG_ACTIVE])->select('id', 'name')->get(); // returns collection of id + name
        return response()->json($skills);
    }
    public function create()
    {
        $industries = Industry::doesntHave('skills')->whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();

        $skills = Skill::whereRaw('`flags` & ? = ?', [Skill::FLAG_ACTIVE, Skill::FLAG_ACTIVE])->get();
        // dd($industries);
        // dd($skills);
        return view('admin.industry-skill.create', compact('industries', 'skills'));
    }
     public function store(Request $request)
    {
        $request->validate([
            'industry_id' => 'required|exists:industries,id',
            'skill_ids.*' => 'required|exists:skills,id',
        ]);
        

       $industry = Industry::findOrFail($request->industry_id);
       

    // Add or update multiple skills
   $syncData = [];
    foreach ($request->skill_ids as $skillId) {
        $syncData[$skillId] = ['flags' => IndustrySkill::FLAG_ACTIVE, 'industry_skill_id' => (String) Str::uuid()];
    }
   
    $industry->skills()->sync($request->skill_ids);
              
        return redirect()->back()->with('success', 'Skill linked to industry successfully!');
    }


    public function edit($id) {
        $selectedIndustryId = $id;
        $industries = Industry::all();
        $allSkills = Skill::all();
        $selectedSkills = [];

        if ($selectedIndustryId) {
            $industry = Industry::with('skills')->find($selectedIndustryId);
            if ($industry) {
                $selectedSkills = $industry->skills->pluck('id')->toArray();
            }
        }
        return view('admin.industry-skill.is-edit', compact('industries', 'allSkills', 'selectedIndustryId', 'selectedSkills'));
    }
    public function update(Request $request, $id) {
        // return $id;
       

        $industry = Industry::findOrFail($id);
         $skillIds = $request->skill_ids ?? [];

        $syncData = [];

        foreach ($skillIds as $id) {
            $syncData[$id] = ['flags' => IndustrySkill::FLAG_ACTIVE];
        }

        $industry->skills()->sync($syncData);

        return redirect()->back()->with('success', 'Skills updated successfully.');
    }

    public function getSkillsByIndustry(Request $request)
    {
        $industry = Industry::with('skills')->find($request->industry_id);

        if ($industry) {
            return response()->json($industry->skills);
        }

        return response()->json([]);
    }
}
