<?php

// app/Http/Controllers/Auth/RegisterController.php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\OtpMail;

class RegisterController extends Controller
{
    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle the user registration and OTP generation
    public function register(Request $request)
    {
        // Validate registration form input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:4',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create user and generate OTP
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate OTP
        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_created_at = now(); // Add this line
        $user->save();

        // Send OTP to email
        Mail::to($user->email)->send(new OtpMail($otp));

        // Redirect to OTP verification page
        return redirect()->route('otp.verify.form', ['email' => $user->email]);
    }

    // Show OTP verification form
    public function showOtpForm($email)
    {
        return view('auth.verify-otp', ['email' => $email]);
    }

    // Verify OTP and activate the user
    public function verifyOtp(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Check if OTP is expired (after 5 minutes)
        if (now()->diffInMinutes($user->otp_created_at) > 1) {
            return redirect()->back()->with('error', 'OTP expired. Please register again.');
        }

         // Check if OTP is correct
    if ($user->otp == $request->otp) {
        $user->is_verified = true;
        $user->otp = null; // Clear the OTP
        $user->otp_created_at = null;
        $user->save();

        auth()->login($user);

        return redirect()->route('app.home');
    }

        return redirect()->back()->with('error', 'Invalid OTP!');
    }
}
