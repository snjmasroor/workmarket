<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;

class RecuitmentController extends Controller
{
    public function view_recuitment (Request $request) {
        $contracts = Contract::where('user_id', auth()->id())->latest()->get();
        return view('user.recuitments.view', compact('contracts'));
    }

    public function view_contract (Request $request, $id) {
        $contract = Contract::with(['user', 'job', 'application'])->findOrFail($id);
        return view('user.recuitments.contract', compact('contract'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:accept,decline',
        ]);

        $contract = Contract::where('user_id', auth()->id())->findOrFail($id);

        // Save signature

        if ($request->hasFile('signature')) {
            $file = $request->file('signature');
            $path = public_path('storage/users/signature'); 
            $name = rand(99, 9999999);
            $filenameWithExt = $request->signature->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->signature->getClientOriginalExtension();
            $fileNameToStore = $name . '.' . $extension;
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $path = $request->signature->storeAs("public/users/signature".$contract->id.'/', $fileNameToStore); 
            $contract->signature = $fileNameToStore;
            $contract->save();
        }
            $contract->removeFlag(Contract::FLAG_ACCEPTED);
            $contract->removeFlag(Contract::FLAG_PENDING);
            $contract->removeFlag(Contract::FLAG_ACTIVE);
            $contract->removeFlag(Contract::FLAG_CANCELLED);

        if ($request->action == 'accept') {
            $contract->addFlag(Contract::FLAG_ACCEPTED);
            $contract->addFlag(Contract::FLAG_ACTIVE);
        } else {
            $contract->addFlag(Contract::FLAG_CANCELLED);
        }

        $contract->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Contract ' . $request->action . 'ed successfully.'
        ]);
    }
}
