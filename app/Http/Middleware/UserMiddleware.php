<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->to('/'); // Redirects to user/home URL
        }

        $user = Auth::user();

        if ($user->email_status !== '1') {
            return redirect()->route('email_verify')->with('error', 'You must verify your email before accessing this page.');
        }

        if ($user->user_status !== '1') {
            return redirect()->route('user_verify')->with('error', 'Your account needs verification.');
        }



        // Check if the user is verified and not an admin
        // $user = Auth::user();
        // if ($user->is_verified == 0 && !Auth::guard('admin')->check()) {
        //     return redirect()->route('verify', ['id' => $user->id]);
        // }

        return $next($request);
    }
}
