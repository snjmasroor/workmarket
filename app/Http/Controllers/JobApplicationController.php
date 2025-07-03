<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use Yajra\DataTables\DataTables;

class JobApplicationController extends Controller
{
    public function process() {
        return view('admin.job-application.process');
    }

    
    public function getApplicationsForAdmin(Request $request)
    {
        $query = JobApplication::with(['job', 'user'])->select('job_applications.*');
       
        return DataTables::of($query)
            ->addColumn('id', fn($row) => $row->id ?? 'N/A')
            ->addColumn('job_title', fn($row) => $row->job->title ?? 'N/A')
            ->addColumn('applicant_name', fn($row) => $row->user->name ?? 'N/A')
            ->addColumn('email', fn($row) => $row->user->email ?? 'N/A')
            ->addColumn('flags', function ($row) {
                if ($row->pending) {
                    return '<span class="badge bg-label-warning">Pending</span>';
                } elseif ($row->accepted) {
                    return '<span class="badge bg-label-success">Accepted</span>';
                } elseif ($row->rejected) {
                    return '<span class="badge bg-label-danger">Rejected</span>';
                } elseif ($row->is_hired) {
                    return '<span class="badge bg-label-primary">Hired</span>';
                } else {
                    return '<span class="badge bg-label-secondary">Unknown</span>';
                }
            })
            ->addColumn('action', function ($row) {
                $hireUrl = route('admin.applications.hire', $row->id);
                $contractUrl = route('admin.contracts.create', $row->id);
                
                $viewUrl = "";//route('admin.jobs.', $row->job_id);

                $dropdown = '
                    <div class="dropdown">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="ti ti-dots-vertical"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="'.$viewUrl.'"><i class="ti ti-eye me-1"></i> View Job</a>';

                // ✅ Conditional: Only show contract link if accepted
                if ($row->accepted) {
                    $dropdown .= '<a class="dropdown-item" href="'.$contractUrl.'"><i class="ti ti-file-text me-1"></i> Create Contract</a>';
                }

                // ✅ Hire button (use JS handler, not form submit)
                $dropdown .= '
                            <button type="button" class="dropdown-item btn-hire" data-url="'.$hireUrl.'">
                                <i class="ti ti-user-check me-1"></i> Hire
                            </button>
                        </div>
                    </div>';

                return $dropdown;
            })
            ->rawColumns(['flags', 'action']) // Allow HTML badges and dropdown
            ->make(true);
        

    }
    public function hireApplicant($id)
    {
        $application = JobApplication::findOrFail($id);
        
        $alreadyHired = JobApplication::where('user_id', $application->user_id)
        ->whereRaw('`flags` & ? = ?', [JobApplication::FLAG_ACCEPTED , JobApplication::FLAG_ACCEPTED])
        ->where('id', '!=', $application->id)
        ->exists();

    if ($alreadyHired) {
        return response()->json([
            'success' => false,
            'message' => 'This user is already hired for another job.'
        ]);
    }

        // Optional: Un-hire others from the same job
        JobApplication::where('job_id', $application->job_id)
                    ->where('id', '!=', $id);

        $application->removeFlag(JobApplication::FLAG_PENDING);
        $application->addFlag(JobApplication::FLAG_ACCEPTED); // or a new flag if needed
        $application->save();

        return response()->json([
            'success' => true,
            'message' => 'User has been hired successfully.'
        ]);
    }
}
