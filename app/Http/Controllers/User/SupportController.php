<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Support;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $supportRequests = Support::where('user_id', Auth::id())->latest()->get();
        return view('user.support', compact('supportRequests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dept' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $support = new Support();
        $support->user_id = Auth::id();
        $support->dept = $request->dept;
        $support->subject = $request->subject;
        $support->message = $request->message;
        $support->reference = 'SUP-' . strtoupper(Str::random(10));
        $support->status = 'Pending';
        $support->save();

        return redirect()->back()->with('success', 'Support request submitted successfully.');
    }
}
