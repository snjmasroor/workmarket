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
use Illuminate\Support\Facades\Log;
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
        $countries = Country::get();
        $tests = Tests::get();
        $skills = Skill::whereRaw('`flags` & ? = ?', [Skill::FLAG_ACTIVE, Skill::FLAG_ACTIVE])->get();
        return view('admin.jobs.job-create', compact('industries', 'skills', 'tests', 'countries'));
    }

   public function store(Request $request) {
    //  if($request->nda_agreement_switch == true)
    //     return "asdasdasdasd";
    
    
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:1',
            'jobType' => 'required|in:fixed,hourly',
            'jobLocation' => 'required|in:remote,onsite',
            'industry_id' => 'required|exists:industries,id',
        ]);
        
         try {
            DB::beginTransaction();
        
            // Create the Job
            $job = new Job;
            $job->user_id = auth()->id();
            $job->title = $request->title;
            $job->industry_id = $request->industry_id;
            $job->budget = $request->budget;
            $job->fixed_rate = $request->fixed_rate;
            $job->rate_per_hour = $request->hourly_rate;
            $job->estimated_hours = $request->estimated_hours;
            $job->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $job->deadline = Carbon::parse($request->deadline)->format('Y-m-d');
            $job->country = Country::find($request->country_id)->name ?? null;
            $job->state = State::find($request->state_id)->name ?? null;
            $job->city = $request->city;
            $job->address = $request->address;
            $job->zip = $request->zip;
            $job->radius = $request->radius;
            $job->payment_terms = $request->payment_terms;
            $job->conditions = htmlspecialchars($request->conditions);
            $job->terms_acceptance = htmlspecialchars($request->terms_acceptance);
            $job->description = htmlspecialchars($request->description);
            $job->addFlag(Job::FLAG_ACTIVE);

            // NDA & Admin Status
            if ($request->nda_agreement_switch == true) {
                Log::info('NDA switch is ON');
                $job->addFlag(Job::FLAG_NDA_AGREMENT);                
            }
            if($request->jobType == 'fixed') {
                $job->addFlag(Job::FLAG_FIXED);
            }else {
                $job->addFlag(Job::FLAG_HOURLY);
            }
            if($request->jobLocation == 'remote') {
                $job->addFlag(Job::FLAG_REMOTE);
            }else {
                $job->addFlag(Job::FLAG_ONSITE);
            }
            switch ($request->superadmin_switch) {
                case 'open':
                    $job->addFlag(Job::FLAG_OPEN);
                    break;
                case 'in_progress':
                    $job->addFlag(Job::FLAG_IN_PROGRESS);
                    break;
                case 'completed':
                    $job->addFlag(Job::FLAG_COMPLETED);
                    break;
                case 'cancelled':
                    $job->addFlag(Job::FLAG_CANCELLED);
                    break;
                default:
                    $job->addFlag(Job::FLAG_IN_PROGRESS);
            }
            $job->save();
        
        
            // Add Job Qualifications
            $job->qualifications()->create([
                'education_level' => $request->education_level,
                'min_years_experience' => $request->min_years_experience,
                'field' => $request->field_of_study,
                'language' => $request->language,
            ]);
        
            
           
            
        
            // Sync Skills
            if ($request->filled('skill_ids')) {
                $job->skills()->sync($request->skill_ids);
            }
        
            // Sync Certifications
            if ($request->filled('certifications')) {
                $job->certifications()->sync($request->certifications);
            }
        
            // Add Tests
            if ($request->test_swtich === 'on' && $request->has('test')) {
                foreach ($request->test as $test) {
                    $job->tests()->create([
                        'test_id' => $test['test_id'],
                        'scoring_criteria' => $test['scoring_criteria'],
                    ]);
                }
            }
        
            // Sync Tools
            if ($request->tools_swtich === 'on' && $request->has('tools')) {
                $job->tools()->sync($request->tools);
            }
        
            DB::commit();
        
            return response()->json(['success' => true, 'job_id' => $job->id]);
        
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Job creation failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        
            return redirect()->back()->withInput()->with('error', 'Job creation failed. Please try again.');
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

    public function data_api(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $jobs = Job::query()
            ->whereRaw('`flags` & ? = ?', [Job::FLAG_ACTIVE, Job::FLAG_ACTIVE])
            ->whereRaw('`flags` & ? = ?', [Job::FLAG_OPEN, Job::FLAG_OPEN])
            ->with('industry')
            ->latest()
            ->orderBy('id', 'desc')
            ->paginate(10);

        return response()->json($jobs);
    }

    public function show($id){
        $job = Job::with([
            'user',
            'skills',
            'tools',
            'tests',
            'qualifications',
            'industry'
        ])->find($id);
    
        if (!$job) {
            abort(404, 'Job not found');
        }
        return view('user.jobs.detail', compact('job'));
    }

}
