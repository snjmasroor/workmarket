<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Contract;
use App\Models\User;
use App\Notifications\ContractSent;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class ContractController extends Controller
{
    public function contracts() {
        return view('admin.contracts.contract-index');
    }
    public function data()
    {
        $contracts = Contract::with(['user', 'job'])->orderByDesc('id');

        return DataTables::of($contracts)
            ->addColumn('id', fn($c) => $c->id ?? 'N/A')
            ->addColumn('user_name', fn($c) => $c->user->name ?? 'N/A')
            ->addColumn('job_title', fn($c) => $c->job->title ?? 'N/A')
            ->addColumn('amount', fn($c) => number_format($c->amount, 2) . ' PKR')
            ->addColumn('start_date', fn($c) => $c->start_date ? Carbon::parse($c->start_date)->format('d M, Y') : 'N/A')

            ->addColumn('end_date', fn($c) => $c->end_date ? Carbon::parse($c->end_date)->format('d M, Y') : 'N/A')
            ->addColumn('status', fn($c) => $c->accepted == 'accepted'
                ? '<span class="badge bg-success">Accepted</span>'
                : '<span class="badge bg-warning">Pending</span>')
            //->editColumn('accepted_at', fn($c) => $c->accepted_at ? $c->accepted_at->format('d M, Y') : 'N/A')
            ->addColumn('action', function ($c) {
                return '
                <a href="' . route('admin.contracts.show', $c->id) . '?key=contract" class="btn btn-sm btn-primary">View</a>
                <a href="' . route('admin.jobs.contract.edit', $c->id) . '" class="btn btn-sm btn-warning ml-1">Edit</a>';
            })
            ->rawColumns(['status', 'action']) // required to render HTML
            ->make(true);
    }

    public function create($id) {
        $application = JobApplication::with(['user', 'job'])->findOrFail($id);
        return view('admin.contracts.contract-create', compact('application'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'job_application_id' => 'required|exists:job_applications,id',
            'user_id' => 'required|exists:users,id',
            'job_id' => 'required|exists:post_jobs,id',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);


        try {
            $application = JobApplication::findOrFail($validated['job_application_id']);
            $contract = new Contract();
            $contract->admin_id = auth()->id();
            $contract->user_id = $validated['user_id'];
            $contract->job_id = $validated['job_id'];


            $contract->job_application_id = $validated['job_application_id'];
            $contract->terms = htmlspecialchars($request->terms);
            $contract->amount = $validated['amount'];
            $contract->start_date = $validated['start_date'];
            $contract->end_date = $validated['end_date'];
            $contract->addFlag(Contract::FLAG_ACTIVE);
            $contract->addFlag(Contract::FLAG_PENDING);
            //$contract->save(); // ✅ Save to database

            if ($contract->save()) {
                $user = User::find($request->user_id); // or $contract->user
                $user->notify(new ContractSent($contract));
                $application->addFlag(JobApplication::FLAG_CONTRACT_SEND);
                $application->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Contract created successfully.',
                'contract' => $contract
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create contract.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function show($id, Request $request) {
        $key = $request->query('key'); // gets ?key=contract
        if ($key == 'contract') {
            $contract = Contract::with(['user', 'job', 'application'])->findOrFail($id);
        }else {
            $contract = Contract::where('job_application_id', $id)->with(['user', 'job', 'application'])->first();
        }
        return view('admin.contracts.show', compact('contract'));

    }
    public function edit($id)
    {
        $contract = Contract::findOrFail($id);
        return view('admin.contracts.edit', compact('contract'));
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        $contract->update([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => 'Contract updated successfully',
            'contract' => $contract
        ]);
    }
}
