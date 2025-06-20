<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Skill;
use App\Models\IndustrySkill;
use App\Models\JobQualification;
use App\Models\Certification;
use App\Models\Country;
use App\Models\State;
use App\Models\Job;
use App\Models\Tests;
use App\Models\Tool;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class JobController extends Controller
{
    //
    public function index() {
        
           $jobs = Job::with('industry')->get();
          return view('admin.jobs.job-index', compact('jobs'));
    }

    public function data(Request $request)
    {
        return DataTables::of(Job::with('industry')->get())
            ->addColumn('industry_name', function ($row) {
                return $row->industry->name ?? 'N/A';
            })
            ->addColumn('description', function ($row) {
                return Str::limit(strip_tags(htmlspecialchars_decode($row->description)), 50) ?? 'N/A';
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
                $editUrl = route('admin.industries.edit', $row->id);
                $deleteUrl = route('admin.industries.destroy', $row->id);
                return '<div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="ti ti-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="'.$editUrl.'"
                                    ><i class="ti ti-pencil me-1"></i> Edit</a
                                >
                                <a class="dropdown-item" href="javascript:void(0);"
                                    ><i class="ti ti-trash me-1"></i> Delete</a
                                >
                                </div>
                            </div>';
            })
            ->rawColumns(['flags', 'action']) // allow HTML rendering
            ->make(true);
    }

    public function create() {
        $industries = Industry::whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();
        $certificates = Certification::get();
        $countries = Country::get();
        $tests = Tests::get();
        $tools = Tool::get();
        $skills = Skill::whereRaw('`flags` & ? = ?', [Skill::FLAG_ACTIVE, Skill::FLAG_ACTIVE])->get();
        return view('admin.jobs.job-create', compact('industries', 'skills', 'certificates', 'tests', 'tools', 'countries'));
    }

   public function store(Request $request) {
    // dd($request->all());

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:1',
            'jobType' => 'required|in:fixed,hourly',
            'jobLocation' => 'required|in:remote,onsite',
            'industry_id' => 'required|exists:industries,id',
        ]);
        
        // try {
            //DB::beginTransaction();

            $job = new Job;
            $job->user_id = auth()->id();
            $job->title = $request->title;
            $job->industry_id = $request->industry_id;
            $job->addFlag($request->jobType === 'fixed' ? Job::FLAG_FIXED : Job::FLAG_HOURLY);
            $job->addFlag($request->jobLocation === 'remote' ? Job::FLAG_REMOTE : Job::FLAG_ONSITE);
            
            $job->budget = $request->budget;
            $job->fixed_rate = $request->fixed_rate;
            $job->rate_per_hour = $request->hourly_rate;
            $job->estimated_hours = $request->estimated_hours;
            $job->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $job->deadline = Carbon::parse($request->deadline)->format('Y-m-d');
            $stateName = State::where('id', $request->state)->value('name');
            $countryName = Country::where('id', $request->country)->value('name');
            $job->country = $countryName;
            $job->state = $stateName;
            $job->city = $request->city;
            $job->address = $request->address;
            $job->zip = $request->zip;
            $job->radius = $request->radius;
            $job->payment_terms = $request->payment_terms;
            $job->conditions = htmlspecialchars($request->conditions);
            $job->terms_acceptance = htmlspecialchars($request->terms_acceptance);
            $job->description = htmlspecialchars($request->description);
            $job->save();
            // dd($job->id);
            

    //         $job_qualification = new JobQualification;
    //         $job_qualification->job_id = $job->id;
    //         $job_qualification->education_level = $request->education_level;
    //         $job_qualification->min_years_experience = $request->min_years_experience;
    //         $job_qualification->field = $request->field_of_study;
    //         $job_qualification->language = $request->language;
    //         $job_qualification->save();
           
           
    //         if($request->nda_agreement_switch === 'on'){
    //             $job->addFlag(Job::FLAG_NDA_AGREMENT);
    //         }
    //         $job->addFlag(Job::FLAG_IN_PROGRESS);

    //         if ($request->superadmin_switch == 'open') {
    //                 $job->addFlag(Job::FLAG_OPEN);

    //         }else if ($request->superadmin_switch == 'in_progress') {
    //                     $job->addFlag(Job::FLAG_IN_PROGRESS);

    //         } else if ($request->superadmin_switch == 'completed') {
    //                 $job->addFlag(Job::FLAG_COMPLETED);

    //         } else if ($request->superadmin_switch == 'cancelled') {
    //                 $job->addFlag(Job::FLAG_CANCELLED);
    //             }
                 
           

    // // Sync skills
    // if ($request->has('skill_ids')) {
    //     $job->skills()->sync($request->skill_ids);
    // }

    // Save certificates
    if ($request->has('certificate')) {
        $certificate = 0;
        foreach ($request->certificate as $cert) {
            $certification = Certification::find(1);
            $certification->jobs()->attach($jobId); 
           $certificate = $job->certificates()->create([
                'certificate_id' => $cert['certificate_id'],
                'job_id'    =>  $job->id,
            ]);
        }
        dd($certificate->id);

    }

    // Save tests
    if ($request->test_swtich === 'on' && $request->has('test')) {
        foreach ($request->test as $test) {
            $job->tests()->create([
                'test_id' => $test['test_id'],
                'job_id'    =>  $job->id,
                'scoring_criteria' => $test['scoring_criteria']
            ]);
        }
    }

    // Save tools
    if ($request->tools_swtich === 'on' && $request->has('tool')) {
        foreach ($request->tool as $tool) {
            $job->tools()->create([
                'tool_id' => $tool['tool_id'],
                'job_id'    =>  $job->id,
            ]);
        }
    }
    $job->save();

    //return response()->json(['success' => true, 'job_id' => $job->id]);

            // // Add flags
            
            
            // if ($request->status == '1') {
            //     $job->addFlag(Job::FLAG_ACTIVE);
            // }

            

            // $job->save();

            // $qualification = new JobQualification;

            // $validatedData = $request->validate([
            //     'education_level' => 'required|string|max:255',
            //     'min_years_experience' => 'nullable|integer|min:0',
            //     'license' => 'nullable|string|max:255',
            //     'language' => 'nullable|string|max:255',
            //     'description' => 'nullable|string',
            //     // 'attachments' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Uncomment if you re-enable attachments
            // ]);
            // $qualification->education_level = $request->education_level;
            // $qualification->min_years_experience = $request->min_years_experience;
            // $qualification->license = $request->license;
            // $qualification->language = $request->language;
            // $qualification->description = $request->description;
            // // $qualification->job_id = $job->id;
            //  $qualification->save();

            // if ($request->hasFile('attachments')) {
            //     $name = rand(99, 9999999);
            //     $extension = $request->attachments->getClientOriginalExtension();
            //     $fileNameToStore = $name . '.' . $extension;
            //     $path = $request->attachments->storeAs("public/jobs/attachments/{$job->id}/", $fileNameToStore);
            //     $job->attachments = "jobs/attachments/{$job->id}/{$fileNameToStore}";
            //     $job->save();
            // }

            // if ($request->has('skill_ids')) {
            //     $job->skills()->sync($request->skill_ids);
            // }



            //DB::commit();
            // return redirect()->route('show.jobs')->with('success', 'Job created.');

        // } catch (\Exception $e) {
        //    // DB::rollBack();
        //     // \Log::error('Job creation failed', ['error' => $e->getMessage()]);
        //     // return redirect()->back()->with('error', 'Job creation failed: ' . $e->getMessage());
        // }
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
