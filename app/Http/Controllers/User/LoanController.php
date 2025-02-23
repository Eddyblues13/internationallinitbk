<?php

namespace App\Http\Controllers\User;

use App\Models\Loan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function apply(Request $request)
    {
        $request->validate([
            'occupation' => 'required|string|max:255',
            'amount' => 'required|numeric|min:1000',
            'message' => 'required|string|max:1000',
        ]);

        $loan = new Loan();
        $loan->user_id = Auth::id();
        $loan->occupation = $request->occupation;
        $loan->amount = $request->amount;
        $loan->message = $request->message;
        $loan->reference = Str::random(10);
        $loan->status = 'pending';
        $loan->save();

        return redirect()->back()->with('success', 'Loan application submitted successfully.');
    }

    public function index()
    {
        $loans = Loan::where('user_id', Auth::id())->latest()->get();
        return view('user.loan', compact('loans'));
    }
}
