<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\ChequeDeposit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ChequeDepositController extends Controller
{

    public function create()
    {
        return view('user.cheque-deposit');
    }
    public function store(Request $request)
    {
        $request->validate([
            'front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'back' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'nullable|string|max:500',
        ]);

        // Handle file uploads
        $frontPath = $request->file('front')->store('uploads/deposits', 'public');
        $backPath = $request->file('back')->store('uploads/deposits', 'public');

        // Store deposit details
        ChequeDeposit::create([
            'user_id' => Auth::id(),
            'front' => $frontPath,
            'back' => $backPath,
            'remarks' => $request->message,
        ]);

        return back()->with('success', 'Deposit uploaded successfully.');
    }
}
