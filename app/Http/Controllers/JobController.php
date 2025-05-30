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
use Purifier;

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
            'jobLocation' => 'required|in:remote,onsite',
            'industry_id' => 'required|exists:industries,id',
            'deadline' => 'required|date_format:d/m/Y|after:today',
            'start_date' => 'required|date_format:d/m/Y|after:today',
            // 'skill_ids' => 'required|array',
            // 'skill_ids.*' => 'exists:skills,id',
            'status' => 'nullable|in:1,0',
        ]);
       

        try {
            DB::beginTransaction();
            if ($request->hasFile('attachments')) {
                $filename = $request->file('attachments')->store('attachments', 'public');
                $job->attachments = $filename;
            }
             dd($filename);
            $job = new Job;
            $job->user_id = auth()->id();
            $job->title = $request->title;
            $job->industry_id = $request->industry_id;
            $job->budget = $request->budget;
            $job->state = $request->state;
            $job->city = $request->city;
            
            $job->deadline = Carbon::createFromFormat('d/m/Y', $request->start_date)->format('Y-m-d');
            $job->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');
            
            $job->address = $request->address;
            $job->zip = $request->zip;
            $job->radius = $request->radius;
            $job->estimated_hours = $request->estimated_hours;
            $job->payment_terms = $request->payment_terms;
            $job->payment_type = $request->payment_type;
            $job->terms = htmlspecialchars($request->terms);
            $job->conditions = htmlspecialchars($request->conditions);
            $job->nda_requirement = htmlspecialchars($request->nda_requirement);
            $job->terms_acceptance = htmlspecialchars($request->terms_acceptance);
            $job->description = htmlspecialchars($request->description);
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
            return redirect()->route('show.jobs')->with('success', 'Job created.');

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

    public function update(Request $request, $id) {
    
        $job = Job::findOrFail($id);
       
        $request->validate([        
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'nullable|numeric',
            'deadline' => 'nullable|date',
            'industry_id' => 'required|exists:industries,id',
            'jobType' => 'required|in:fixed,hourly',
            'jobLocation' => 'required|in:remote,onsite',
            'status' => 'required|in:1,0',
           // 'skill_ids' => 'nullable|array',
            //'skill_ids.*' => 'exists:skills,id',
            'status_admin' => 'nullable|in:open,in_progress,completed,cancelled'
        ]);

    // Update fields
    $job->title = $request->title;
    $job->description = $request->description;
    $job->budget = $request->budget;
    $job->deadline = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');
    $job->industry_id = $request->industry_id;
    $job->state = $request->state;
    $job->city = $request->city;

    $job->removeFlag(Job::FLAG_FIXED);
    $job->removeFlag(Job::FLAG_HOURLY);
    $job->removeFlag(Job::FLAG_ONSITE);
    $job->removeFlag(Job::FLAG_REMOTE);
    $job->removeFlag(Job::FLAG_IN_PROGRESS);
    $job->removeFlag(Job::FLAG_ACTIVE);
    $job->removeFlag(Job::FLAG_OPEN);
    $job->removeFlag(Job::FLAG_COMPLETED);
    $job->removeFlag(Job::FLAG_CANCELLED);

    $job->addFlag($request->jobType == 'fixed' ? Job::FLAG_FIXED : Job::FLAG_HOURLY);
    $job->addFlag($request->jobLocation == 'remote' ? Job::FLAG_REMOTE : Job::FLAG_ONSITE);

   if ($request->status_admin == 'open') {
    $job->addFlag(Job::FLAG_OPEN);

   }else if ($request->status_admin == 'in_progress') {
        $job->addFlag(Job::FLAG_IN_PROGRESS);

   } else if ($request->status_admin == 'completed') {
    $job->addFlag(Job::FLAG_COMPLETED);

   } else if ($request->status_admin == 'cancelled') {
    $job->addFlag(Job::FLAG_CANCELLED);

   }


    if ($request->status == '1') {
        $job->addFlag(Job::FLAG_ACTIVE);
    }

    // Optional admin status (only if superadmin)
    // if (auth()->user()->type == 'superadmin' && $request->has('status_admin')) {
    //     $job->status_admin = $request->status_admin;
    // }

    $job->save();

    // Sync skills (many-to-many)
    if ($request->has('skill_ids')) {
        $job->skills()->sync($request->skill_ids);
    }

    return redirect()->route('show.jobs')->with('success', 'Job updated successfully.');
}

}
