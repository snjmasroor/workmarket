<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;
use App\Models\Contract;
use App\Models\User;
use App\Notifications\ContractSent;

class ContractController extends Controller
{
    

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
            $contract = new Contract();
            $contract->admin_id = auth()->id();
            $contract->user_id = $validated['user_id'];
            $contract->job_id = $validated['job_id'];
            $contract->job_application_id = $validated['job_application_id'];
            $contract->terms = $request->terms;
            $contract->amount = $validated['amount'];
            $contract->start_date = $validated['start_date'];
            $contract->end_date = $validated['end_date'];
            $contract->addFlag(Contract::FLAG_ACTIVE);
            $contract->addFlag(Contract::FLAG_PENDING);
            //$contract->save(); // ✅ Save to database

            if ($contract->save()) {
                $user = User::find($request->user_id); // or $contract->user
                $user->notify(new ContractSent($contract));
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
}
