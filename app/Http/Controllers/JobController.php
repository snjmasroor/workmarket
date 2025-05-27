<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\IndustrySkill;
use App\Models\Job;
use Illuminate\Support\Str;
use Carbon\Carbon;

class JobController extends Controller
{
    //
    public function index() {
        $jobs = Job::get();  
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
         ]);
        //dd($request->all());
        $job = new Job;
        $job->user_id = auth()->user()->id;
        $job->title =  $request->title;
        $job->description = $request->description;
        $job->industry_id = $request->industry_id;
        $job->budget = $request->budget;
        $formattedDate = Carbon::createFromFormat('d/m/Y', $request->deadline)->format('Y-m-d');
        $job->deadline = $formattedDate;
        if ($request->jobType == 'fixed') {
            $job->addFLag(Job::FLAG_FIXED);    
        }else {
            $job->addFLag(Job::FLAG_HOURLY);
        }
        if ($request->jobLocation == 'remote') {
            $job->addFLag(Job::FLAG_REMOTE);    
        }else {
            $job->addFLag(Job::FLAG_ONSITE);
        }
        $job->addFLag(Job::FLAG_IN_PROGRESS);
        if ($request->status == '1') {
            $job->addFLag(Job::FLAG_ACTIVE);
        }
        
        $job->skills()->sync($request->skill_ids);

        if(!$job->save()) {
            return redirect(route('jobs.create'))->with(['req_error' => 'There is some error!']);
        }

       return redirect(route('show.jobs'))->with(['req_success' => 'Your Job information has been successfully saved']);


        
    }
}
