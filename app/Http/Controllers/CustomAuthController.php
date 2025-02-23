<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CustomAuthController extends Controller
{




    /**
     * Handle user activation verification.
     */





    public function emailVerify()
    {
        // Check if the user is authenticated

        // Redirect if email_status is 1
        if (Auth::user()->email_status == 1) {
            return redirect('/home');
        }

        // Show the email verification page
        return view('auth.email_verify');
    }



    public function userVerify()
    {

        // Redirect if email_status is 1
        if (Auth::user()->user_status == 1) {
            return redirect('/home');
        }


        return view('auth.user_verify');
    }






    public function verifyCode(Request $request)
    {
        // Validate the input
        $request->validate([
            'verification_code' => ['required', 'integer'],
        ]);

        $user = Auth::user();

        // Check if the verification code is correct and not expired
        if ($user->verification_code === $request->verification_code) {
            if (now()->lt($user->verification_expiry)) {
                // Mark email as verified
                $user->email_status = 1;
                $user->save();



                $full_name = $user->name;
                $email = $user->email;
                $login_id = $user->login_id; // Assuming 'login_id' exists in the users table
                $password = $user->password; // Be cautious; never expose raw passwords!
                $account_number = $user->account_number; // Assuming 'account_number' exists




                $wMessage = "<p style='line-height: 24px;margin-bottom:15px;'>
                Hello $full_name,
                </p>
                <br>
                <p>We are so happy to have you on board, and thank you for joining us.</p>
                <br>
                <p><strong>Login ID:</strong> $login_id </p>
                  <p><strong>Email Address:</strong>  $email </p>
                <p><strong>Account Number:</strong> $account_number</p>
                <br>
                <p>Don't hesitate to get in touch if you have any questions; we'll always get back to you</p>";



                Mail::to($email)->send(new WelcomeEmail($wMessage));

                return redirect()->route('home')->with('success', 'Your email has been verified successfully!');
            } else {
                return redirect()->back()->withErrors(['verification_code' => 'The verification code has expired. Please request a new one.']);
            }
        } else {
            return back()->withErrors(['verification_code' => 'The verification code is incorrect.']);
        }
    }



    public function resendVerificationCode(Request $request)
    {
        $user = $request->user();

        // Generate and save the verification code and expiry time
        $validToken = rand(1000, 9999);
        $user->verification_code = $validToken;
        $user->verification_expiry = now()->addMinutes(10); // Code expires in 10 minutes
        $user->save();

        $full_name =  $user->fname . ' ' .  $user->lname;
        $email = $user->email;

        $vmessage = "
       <p style='line-height: 24px;margin-bottom:15px;'>
             Hello $full_name,
       </p>
       <br>
        <p>
        We are so happy to have you on board, and thank you for joining us.
        </p>
        <p>
       We just need to verify your email address before you can access cytopiacapital.
       </p>
       <br>
       <p>
      Use this code to verify your email: <strong>$validToken</strong>
      </p>
      <p style='color: red;'>
      Please note that this code will expire in 10 minutes.
     </p>
    <br>
    <p>
    Don't hesitate to get in touch if you have any questions; we'll always get back to you.
    </p>
    ";

        Mail::to($email)->send(new VerificationEmail($vmessage));

        // Flash success message to the session
        return redirect()->back()->with('success', 'A new verification code has been sent to your email.');
    }
}
