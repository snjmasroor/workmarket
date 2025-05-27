<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\IndustrySkill;
use Illuminate\Support\Str;


class IndustrySkillController extends Controller
{
   public function index() {
       $industry_skills = Industry::with('skills')->get();  
        return view('admin.industry-skill.index', compact('industry_skills'));
    }
    public function create()
    {
        $industries = Industry::whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();
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
        $syncData[$skillId] = ['flags' => (int) $request->status, 'industry_skill_id' => (String) Str::uuid()];
    }
   
    $industry->skills()->sync($request->skill_ids);
              
        return redirect()->back()->with('success', 'Skill linked to industry successfully!');
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
