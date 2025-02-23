<?php

namespace App\Http\Controllers\User;

use App\Models\CardDeposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CardDepositController extends Controller
{
    public function create()
    {
        return view('user.card-deposit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account' => 'required',
            'amount' => 'required|numeric|min:1',
            'cardType' => 'required',
            'cardName' => 'required|string|max:255',
            'cardNumber' => 'required|string|max:16',
            'cardExp' => 'required|string|max:7',
            'cardCvv' => 'required|string|max:4',
        ]);

        CardDeposit::create([
            'user_id' => Auth::id(),
            'account' => $request->account,
            'amount' => $request->amount,
            'cardType' => $request->cardType,
            'cardName' => $request->cardName,
            'cardNumber' => $request->cardNumber,
            'cardExp' => $request->cardExp,
            'cardCvv' => $request->cardCvv,
        ]);

        return redirect()->back()->with('success', 'Deposit request submitted successfully.');
    }
}
