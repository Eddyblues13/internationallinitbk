<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Activity;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\VerificationEmail;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function step1Submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        // Store the validated data in the session
        $request->session()->put('registration_data', $validated);

        return redirect()->route('register');
    }

    /**
     * Show the registration form (Step 2).
     */
    public function showRegistrationForm()
    {
        $registrationData = session('registration_data');

        if (!$registrationData) {
            return redirect()->route('registration.step1')->with('error', 'Please complete Step 1 first.');
        }

        return view('auth.register', compact('registrationData'));
    }


    /**
     * Handle user registration.
     */
    // public function register(Request $request)
    // {
    //     // Validate the form data
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email', // Ensure table name matches
    //         'phone' => 'required|string|max:20',
    //         'dob' => 'nullable|date',
    //         'gender' => 'nullable|string|max:10',
    //         'ssn' => 'nullable|string|max:50',
    //         'occupation' => 'nullable|string|max:100',
    //         'country' => 'nullable|string|max:100',
    //         'city' => 'nullable|string|max:100',
    //         'zip' => 'nullable|string|max:20',
    //         'address' => 'nullable|string|max:255',
    //         'nok_name' => 'nullable|string|max:255',
    //         'nok_email' => 'nullable|email',
    //         'nok_phone' => 'nullable|string|max:20',
    //         'nok_relationship' => 'nullable|string|max:100',
    //         'nok_address' => 'nullable|string|max:255',
    //         'currency' => 'nullable|string|max:10',
    //         'password' => 'required|string|min:4|confirmed',
    //         'pin' => 'required|string|digits:4', // Ensuring only 4-digit PIN
    //         'passport' => 'nullable|file|mimes:png,jpg,gif|max:5120', // 5MB max
    //         'kyc' => 'nullable|file|mimes:pdf,png,jpg,gif|max:5120', // 5MB max
    //     ]);

    //     // If validation fails, redirect back with errors and old input
    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     try {
    //         DB::beginTransaction(); // Start database transaction

    //         // Handle file uploads
    //         $passportPath = $request->hasFile('passport')
    //             ? $request->file('passport')->storeAs('passports', time() . '_' . $request->file('passport')->getClientOriginalName(), 'public')
    //             : null;

    //         $kycPath = $request->hasFile('kyc')
    //             ? $request->file('kyc')->storeAs('kycs', time() . '_' . $request->file('kyc')->getClientOriginalName(), 'public')
    //             : null;

    //         $plainPassword = $request->password;

    //         // Generate login_id and account_number
    //         $loginId = strtoupper(substr($request->name, 0, 3)) . rand(1000, 9999);
    //         $accountNumber = rand(1000000000, 9999999999); // Generate a 10-digit account number

    //         // Create a new user
    //         $user = new User();
    //         $user->fill($request->except(['password', 'password_confirmation', 'passport', 'kyc']));

    //         $user->password = bcrypt($request->password);
    //         $user->passport_path = $passportPath;
    //         $user->plain = $plainPassword;
    //         $user->kyc_path = $kycPath;

    //         // Save generated login_id and account_number
    //         $user->login_id = $loginId;
    //         $user->account_number = $accountNumber;

    //         // Generate and save verification code
    //         $user->verification_code = rand(1000, 9999);
    //         $user->verification_expiry = now()->addMinutes(10);
    //         $user->save();

    //         $this->sendVerificationEmail($user);

    //         DB::commit(); // Commit transaction

    //         Auth::login($user);

    //         return redirect()->route('email_verify')->with('success', 'Account created successfully!');
    //     } catch (\Exception $e) {

    //         return redirect()->back()->withInput()->with('error', 'An error occurred while processing your request.');
    //     }
    // }

    public function register(Request $request)
    {
        // Validate input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'ssn' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'city' => 'nullable|string|max:100',
            'zip' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'nok_name' => 'nullable|string|max:255',
            'nok_email' => 'nullable|email',
            'nok_phone' => 'nullable|string|max:20',
            'nok_relationship' => 'nullable|string|max:100',
            'nok_address' => 'nullable|string|max:255',
            'currency' => 'nullable|string|max:10',
            'password' => 'required|string|min:4|confirmed',
            'pin' => 'required|numeric|digits_between:4,4',
            'passport' => 'nullable|file|mimes:png,jpg,gif|max:5120',
            'kyc' => 'nullable|file|mimes:pdf,png,jpg,gif|max:5120',
        ]);

        // Handle file uploads with unique naming
        $passportPath = $request->hasFile('passport')
            ? $request->file('passport')->storeAs('passports', time() . '_' . $request->file('passport')->getClientOriginalName(), 'public')
            : null;

        $kycPath = $request->hasFile('kyc')
            ? $request->file('kyc')->storeAs('kycs', time() . '_' . $request->file('kyc')->getClientOriginalName(), 'public')
            : null;


        // Handle file uploads with unique naming and store in the public folder
        if ($request->hasFile('passport')) {
            $passportFile = $request->file('passport');
            $passportName = time() . '_' . $passportFile->getClientOriginalName();
            $passportPath = 'uploads/passports/' . $passportName;
            $passportFile->move(public_path('uploads/passports'), $passportName);
        }

        if ($request->hasFile('kyc')) {
            $kycFile = $request->file('kyc');
            $kycName = time() . '_' . $kycFile->getClientOriginalName();
            $kycPath = 'uploads/kycs/' . $kycName;
            $kycFile->move(public_path('uploads/kycs'), $kycName);
        }


        // Get the user agent string
        $userAgent = $request->header('User-Agent');

        // Generate a unique login ID & account number
        $loginId = strtoupper(Str::random(3)) . rand(1000, 9999);

        $accountNumber = rand(1000000000, 9999999999);


        // Create the user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'dob' => $validated['dob'] ?? null,
            'gender' => $validated['gender'] ?? null,
            'ssn' => $validated['ssn'] ?? null,
            'occupation' => $validated['occupation'] ?? null,
            'country' => $validated['country'] ?? null,
            'city' => $validated['city'] ?? null,
            'zip' => $validated['zip'] ?? null,
            'address' => $validated['address'] ?? null,
            'nok_name' => $validated['nok_name'] ?? null,
            'nok_email' => $validated['nok_email'] ?? null,
            'nok_phone' => $validated['nok_phone'] ?? null,
            'nok_relationship' => $validated['nok_relationship'] ?? null,
            'nok_address' => $validated['nok_address'] ?? null,
            'currency' => $validated['currency'] ?? '$',
            'password' => Hash::make($validated['password']),
            'pin' => $validated['pin'] ?? '1234', // Securely hash the PIN
            'passport_path' => $passportPath ?? null,
            'kyc_path' => $kycPath ?? null,
            'login_id' =>  strtoupper(Str::random(3)) . rand(1000, 9999),
            'account_number' => rand(1000000000, 9999999999),
            'plain' => $validated['password'],
            'verification_code' => rand(1000, 9999),
            'verification_expiry' => now()->addMinutes(10),
        ]);


        // Log user activity
        Activity::create([
            'user_id'                => $user->id,
            'last_login_at'          => Carbon::now()->toDateTimeString(),
            'last_login_ip'          => $request->getClientIp(),
            'last_login_user_agent'  => $userAgent
        ]);

        // Send verification email if needed
        $this->sendVerificationEmail($user);

        Auth::login($user);

        return redirect()->route('home')->with('success', 'Account created successfully!');
    }





    protected function sendVerificationEmail(User $user)
    {


        $vmessage = "
        <p>Hello {$user->name},</p>
        <p>We are so happy to have you on board. We need to verify your email address.</p>
        <p>Use this code to verify your email: <strong>{$user->verification_code}</strong></p>
        <p>Please note that this code will expire in 10 minutes.</p>
    ";

        Mail::to($user->email)->send(new VerificationEmail($vmessage));
    }


    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('home.login');
    }

    /**
     * Handle user login.
     */


    public function login(Request $request)
    {
        // Get the user agent string
        $userAgent = $request->header('User-Agent');

        // Validate input
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Determine if login input is an email or phone number
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login_id';

        // Attempt login with either email or phone
        if (Auth::attempt([$fieldType => $request->login, 'password' => $request->password])) {
            $user = Auth::user(); // Retrieve authenticated user

            // Log user activity
            Activity::create([
                'user_id'                => $user->id,
                'last_login_at'          => Carbon::now()->toDateTimeString(),
                'last_login_ip'          => $request->getClientIp(),
                'last_login_user_agent'  => $userAgent
            ]);

            return redirect()->route('home')->with('success', 'Logged in successfully!'); // Redirect to dashboard
        }

        // If login fails, redirect back with an error
        return redirect()->back()->withErrors(['login' => 'Invalid login credentials'])->withInput();
    }


    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        Password::sendResetLink($request->only('email'));

        return back()->with('success', 'Password reset link sent to your email.');
    }




    /**
     * Handle user logout.
     */
}
