<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\SavingsBalance;
use App\Models\CheckingBalance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionNotificationMail;

class TransactionController extends Controller
{
    public function creditSavings(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $amount = $request->amount;

        SavingsBalance::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'type' => 'credit',
            'status' => 'active'
        ]);

        Mail::to($user->email)->send(new TransactionNotificationMail($user, $amount, 'Savings Balance', 'Credit'));

        return back()->with('success', 'Savings balance credited successfully.');
    }

    public function debitSavings(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $amount = $request->amount;

        SavingsBalance::create([
            'user_id' => $user->id,
            'amount' => -$amount,
            'type' => 'debit',
            'status' => 'active'
        ]);

        Mail::to($user->email)->send(new TransactionNotificationMail($user, $amount, 'Savings Balance', 'Debit'));

        return back()->with('success', 'Savings balance debited successfully.');
    }

    public function creditChecking(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $amount = $request->amount;

        CheckingBalance::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'type' => 'credit',
            'status' => 'active'
        ]);

        Mail::to($user->email)->send(new TransactionNotificationMail($user, $amount, 'Checking Balance', 'Credit'));

        return back()->with('success', 'Checking balance credited successfully.');
    }

    public function debitChecking(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $amount = $request->amount;

        CheckingBalance::create([
            'user_id' => $user->id,
            'amount' => -$amount,
            'type' => 'debit',
            'status' => 'active'
        ]);

        Mail::to($user->email)->send(new TransactionNotificationMail($user, $amount, 'Checking Balance', 'Debit'));

        return back()->with('success', 'Checking balance debited successfully.');
    }
}
