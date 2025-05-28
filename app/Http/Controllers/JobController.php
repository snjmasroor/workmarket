<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\IndustrySkill;
use App\Models\Job;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    //
    public function index() {
           $jobs = Job::with('industry')->get();
          return view('admin.jobs.index', compact('jobs'));
    }

    public function create() {
        $industries = Industry::whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();
        $skills = Skill::whereRaw('`flags` & ? = ?', [Skill::FLAG_ACTIVE, Skill::FLAG_ACTIVE])->get();
        return view('admin.jobs.create', compact('industries', 'skills'));
    }

   public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:1',
            'jobType' => 'required|in:fixed,hourly',
            'jobLocation' => 'required|in:remote,on-site',
            'industry_id' => 'required|exists:industries,id',
            'deadline' => 'required|date_format:d/m/Y|after:today',
            // 'skill_ids' => 'required|array',
            // 'skill_ids.*' => 'exists:skills,id',
            'status' => 'nullable|in:1,0',
        ]);
        

        try {
            DB::beginTransaction();

            $job = new Job;
            $job->user_id = auth()->id();
            $job->title = $request->title;
            $job->description = $request->description;
            $job->industry_id = $request->industry_id;
            $job->budget = $request->budget;
            $job->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');

        // Flags
            $job->addFlag($request->jobType === 'fixed' ? Job::FLAG_FIXED : Job::FLAG_HOURLY);
            $job->addFlag($request->jobLocation === 'remote' ? Job::FLAG_REMOTE : Job::FLAG_ONSITE);
            $job->addFlag(Job::FLAG_IN_PROGRESS);

            if ($request->status == '1') {
                $job->addFlag(Job::FLAG_ACTIVE);
            }

            // Save job — this MUST happen first
            $job->save();

        if (!$job->exists) {
            throw new \Exception("Job was not saved to DB.");
        }

        // Attach skills with flags
        if ($request->has('skill_ids')) {
                $job->skills()->sync($request->skill_ids);
            
            }
            DB::commit();
            return redirect()->route('jobs.index')->with('success', 'Job created.');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Job creation failed', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Job creation failed: ' . $e->getMessage());
        }
    }


    public function edit($id) {
        $job = Job::findOrFail($id);
        $industries = Industry::whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();
        $skills = Skill::all();
        return view('admin.jobs.edit', compact('job', 'industries', 'skills'));
    }

}
