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
use App\Models\JobApplication;
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
        
        return DataTables::of(Job::where('user_id', auth()->id())->with('industry')->orderBy('id', 'desc'))
            ->addColumn('industry_name', function ($row) {
                return $row->industry->name ?? 'N/A';
            })
            ->addColumn('description', function ($row) {
                return Str::limit(strip_tags(htmlspecialchars_decode($row->description)), 50) ?? 'N/A';
            })
            ->addColumn('flags', function ($row) {
                if ($row->active === true || $row->active == 1) {
                    if ($row->open === true || $row->open == 1) {
                        return '<span class="badge bg-label-primary me-1">Open</span> 
                        <span class="badge bg-label-success me-1">Active</span>';
                    }
                    return '<span class="badge bg-label-success me-1">Active</span>';
                } elseif ($row->active === false || $row->active == 0) {
                    return '<span class="badge bg-label-warning me-1">Inactive</span>';
                } else {
                    return '<span class="badge bg-secondary">None</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $editUrl = route('admin.jobs.edit', $row->id);
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
            $job->country = $request->country ?? null;
            $job->state = $request->state ?? null;
            $job->city = $request->city;
            $job->address = $request->address;
            $job->latitude = $request->latitude;
            $job->longitude = $request->longitude;
            $job->zip = $request->zip;
            $job->radius = $request->radius;
            $job->payment_terms = $request->payment_terms;
            $job->conditions = htmlspecialchars($request->conditions);
            $job->terms_acceptance = htmlspecialchars($request->terms_acceptance);
            $job->description = htmlspecialchars($request->description);
            $job->addFlag(Job::FLAG_ACTIVE);
            
            $admin = auth()->user();
            $company = $admin->company;
            $job->company_id = $company->id;
            
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
    
        $job = Job::with([
            'skills',
            'qualifications',
            'certifications',
            'tests',
            'tools'
        ])->findOrFail($id);
    
        $industries = Industry::whereRaw('`flags` & ? = ?', [Industry::FLAG_ACTIVE, Industry::FLAG_ACTIVE])->get();

        // All static/shared data
        $skills = Skill::all();
        $tests = Tests::all();
        $tools = Tool::all();
        $certifications = Certification::all();

        return view('admin.jobs.edit', compact(
            'job',
            'industries',
            'skills',
            'tests',
            'tools',
            'certifications'
        ));
    }

    public function update(Request $request, Job $job) {

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

            // Update Job Fields
            $job->title = $request->title;
            $job->industry_id = $request->industry_id;
            $job->budget = $request->budget;
            $job->fixed_rate = $request->fixed_rate;
            $job->rate_per_hour = $request->hourly_rate;
            $job->estimated_hours = $request->estimated_hours;
            $job->start_date = Carbon::parse($request->start_date)->format('Y-m-d');
            $job->deadline = Carbon::parse($request->deadline)->format('Y-m-d');
            $job->country = $request->country ?? null;
            $job->state = $request->state ?? null;
            $job->city = $request->city;
            $job->address = $request->address;
            $job->latitude = $request->latitude;
            $job->longitude = $request->longitude;
            $job->zip = $request->zip;
            $job->radius = $request->radius;
            $job->payment_terms = $request->payment_terms;
            $job->conditions = htmlspecialchars($request->conditions);
            $job->terms_acceptance = htmlspecialchars($request->terms_acceptance);
            $job->description = htmlspecialchars($request->description);

            // Reset Flags before updating
            $job->removeFlag(Job::FLAG_ACTIVE);
            $job->removeFlag(Job::FLAG_NDA_AGREMENT);
            $job->removeFlag(Job::FLAG_FIXED);
            $job->removeFlag(Job::FLAG_HOURLY);
            $job->removeFlag(Job::FLAG_REMOTE);
            $job->removeFlag(Job::FLAG_ONSITE);
            $job->removeFlag(Job::FLAG_OPEN);
            $job->removeFlag(Job::FLAG_IN_PROGRESS);
            $job->removeFlag(Job::FLAG_COMPLETED);
            $job->removeFlag(Job::FLAG_CANCELLED);
        

            $job->addFlag(Job::FLAG_ACTIVE);

            if ($request->nda_agreement_switch == true) {
                $job->addFlag(Job::FLAG_NDA_AGREMENT);                
            }

            if ($request->jobType == 'fixed') {
                $job->addFlag(Job::FLAG_FIXED);
            } else {
                $job->addFlag(Job::FLAG_HOURLY);
            }

            if ($request->jobLocation == 'remote') {
                $job->addFlag(Job::FLAG_REMOTE);
            } else {
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

            // Update or Create Qualifications
            $job->qualifications()->updateOrCreate(
                ['job_id' => $job->id],
                [
                    'education_level' => $request->education_level,
                    'min_years_experience' => $request->min_years_experience,
                    'field' => $request->field_of_study,
                    'language' => $request->language,
                ]
            );

            // Sync Skills
            if ($request->filled('skill_ids')) {
                $job->skills()->sync($request->skill_ids);
            }

            // Sync Certifications
            if ($request->filled('certifications')) {
                $job->certifications()->sync($request->certifications);
            }

            // Update Tests
            $job->tests()->delete(); // Delete existing tests before re-adding
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
            Log::error('Job update failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->back()->withInput()->with('error', 'Job update failed. Please try again.');
    }
       
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

    public function job_per_pay($id) {
       $job = Job::find($id);

        $budget = $job->budget; //$request->input('budget', 1500.00);
        $fixedRate = $job->fixed_rate;//$request->input('fixed_rate', 200.00);
        $platformCommissionRate = 0.15; // 15% platform commission
        $salesTaxRate = 0.056; // 5.6% Arizona sales tax

        // Calculate components
        $workerPayment = $fixedRate * (1 - $platformCommissionRate);
        $platformCommission = $fixedRate * $platformCommissionRate;
        $salesTax = $platformCommission * $salesTaxRate;
        $totalJobPostingFees = $platformCommission + $salesTax;
        $totalCharge = $fixedRate + $salesTax;
        $totalCharge;

        // Check if within budget
        $withinBudget = $totalCharge <= $budget;

        // Prepare data for view
        $data = [
            'budget' => number_format($budget, 2),
            'fixed_rate' => number_format($fixedRate, 2),
            'worker_payment' => number_format($workerPayment, 2),
            'platform_commission' => number_format($platformCommission, 2),
            'sales_tax' => number_format($salesTax, 2),
            'total_charge' => number_format($totalCharge, 2),
            'totalJobPostingFees' => number_format($totalJobPostingFees, 2),
            'within_budget' => $withinBudget ? 'Yes' : 'No',
        ];
    
        if (!$job) {
            abort(404, 'Job not found');
        }
        return view('admin.jobs.commission', compact('job', 'data'));
    }

    public function apply(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        // $job = Job::find($id);

        if (!$job) {
            return response()->json(['status' => 'error', 'message' => 'Job not found'], 404);
        }
    
        if ($job->open !== true) {
            return response()->json(['status' => 'error', 'message' => 'Job is not open'], 403);
        }
    
        $alreadyApplied = JobApplication::where('user_id', $request->user()->id)
            ->where('job_id', $id)
            ->exists();
    
        if ($alreadyApplied) {
            return response()->json(['status' => 'error', 'message' => 'Already applied'], 409);
        }
    
        $application = new JobApplication();
        $application->user_id = $request->user()->id;
        $application->job_id = $id;
        // $application->addFlag(JobApplication::FLAG_ACTIVE);
        $application->addFlag(JobApplication::FLAG_PENDING);
        // $application->cover_letter = $request->cover_letter; // uncomment if needed
        $application->save();
    
        return response()->json(['status' => 'success', 'message' => 'Application submitted']);
    }

}
