<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ChequeDeposit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ChequeDepositController extends Controller
{
    public function show(ChequeDeposit $chequeDeposit)
    {
        return view('admin.cheque_history_show', compact('chequeDeposit'));
    }

    public function update(Request $request, ChequeDeposit $chequeDeposit)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected'
        ]);

        $chequeDeposit->update(['status' => $request->status]);

        return back()->with('message', 'Status updated successfully');
    }

    public function destroy(ChequeDeposit $chequeDeposit)
    {
        // Delete associated files
        Storage::delete([$chequeDeposit->front, $chequeDeposit->back]);

        $chequeDeposit->delete();

        return redirect()->route('admin.cheque-deposits.index')
            ->with('message', 'Record deleted successfully');
    }
}
