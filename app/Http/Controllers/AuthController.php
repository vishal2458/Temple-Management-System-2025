<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\RegistrationMail;
use App\Jobs\SendRegistrationEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Jobs\SendPasswordResetEmail;


class AuthController
{

    public function loginAction(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'we cannot find any user associated witht his email.',
            ]);
            // return redirect()->back()->with('error','we cannot find any user associated witht his email');
        }
        if($user->is_verified)
        {
            if ($user && password_verify($request->password, $user->password)) {

                Auth::login($user);
                Session::put('user', [
                    'id' => $user->id,
                    'name' => $user->first_name,
                    'email' => $user->email,
                    'is_admin' => $user->is_admin,
                ]);
                if($user->is_admin)
                {
                   $redirect_link = route( 'admin.dashboard');
                }else {
                    $redirect_link = route( 'home');
                }
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully!',
                    'redirectUrl' => $redirect_link
                ]);
                // return redirect()->intended('/dashboard');
            }
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'Unverified Email Please check your email and verify it',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Invalid credentials, please try again.',
        ]);
        // return back()->with('error', 'Invalid credentials. Please try again.');
    }

    public function registrationAction(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'gender' => 'required',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|digits:10',
            'password' => 'required|string|confirmed|min:3',
        ]);

        $randomString = Str::random(32);
        $currentDateTime = now()->format('Y-m-d H:i:s');
        $encodedDateTime = hash('sha256', $currentDateTime);
        $verificationCode = $randomString . '.' . $encodedDateTime;

        $user = User::create([
            "first_name" =>  $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" =>   $request->last_name,
            "gender" =>   $request->gender,
            "email" =>       $request->email,
            "mobile_no" =>      $request->mobile,
            'password' => Hash::make($request->password),
            'verification_code' => $verificationCode
        ]);

        if ($user) {
            $user_id = Crypt::encrypt($user->id);
            $verificationLink = url('/verify-email/' . $verificationCode . '?user=' . urlencode($user_id));
            $data = [
                'name' => $request->full_name,
                'email' => $request->email,
                'verification_link' => $verificationLink
            ];
            try {
                SendRegistrationEmail::dispatch($data);
            } catch (\Throwable $th) {
                \Log::error('Email queuing failed: ' . $th->getMessage());
            }
            return response()->json([
                'status' => 'success',
                'message' => 'An Email for verification is sent at your given Enail address!',
                'redirectUrl' => route('login')
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Registration failed. Please try again.'
            ]);
        }
    }
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        $emailExists = User::where('email', $email)->exists();

        return response()->json(['valid' => !$emailExists]);
    }
    public function verifyEmail(Request $request,$verificationCode)
    {
        try {
            $encryptedUserId = $request->query('user');
            $userId = Crypt::decrypt($encryptedUserId);
            $user = User::where('id', $userId)
            ->where('verification_code', $verificationCode)
            ->first();
            if (!$user) {
                return response()->json(['status' => 'error', 'message' => 'Invalid or expired verification link.']);
            }

            if ($user->is_verified) {
                return response()->json(['status' => 'error', 'message' => 'User is already verified.']);
            }

            $user->is_verified = true;
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->save();


            Auth::login($user);
            Session::put('user', [
                'id' => $user->id,
                'name' => $user->first_name,
                'email' => $user->email,
                'is_admin' => $user->is_admin,
            ]);
            return redirect()->route('home')->with('status', 'Verification successful Login Now');

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return response()->json(['status' => 'error', 'message' => 'Invalid user ID.']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'An error occurred.']);
        }
    }

    public function updatebasicdetails(Request $request,$id)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'gender' => 'required',
            'last_name' => 'required|string|max:255',
            'mobile' => 'required|digits:10',
        ]);
        $user = User::find($id);
        $userupdate = $user->update([
            "first_name" =>  $request->first_name,
            "middle_name" => $request->middle_name,
            "last_name" =>   $request->last_name,
            "gender" =>   $request->gender,
            "mobile_no" =>      $request->mobile,
        ]);

        if($userupdate)
        {
            return response()->json([
                'status' => 'success',
                'message' => 'An Email for verification is sent at your given Enail address!',
                'redirectUrl' => route('login')
            ]);
        }else {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong. Please try again later.'
            ]);
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect()->route('home')->with('status','Loged out');
    }

    public function checkemailforpassword(Request $request)
    {
        $email = $request->input('email');
        $emailExists = User::where('email', $email)->exists();

        return response()->json(['valid' => $emailExists]);
    }
    public function sendPasswordmail(Request $request)
    {

        $user = User::where('email',$request->email)->first();
        if($user)
        {
            $randomString = Str::random(32);
            $currentDateTime = now()->format('Y-m-d H:i:s');
            $encodedDateTime = hash('sha256', $currentDateTime);
            $verificationCode = $randomString . '.' . $encodedDateTime;
            $verificationLink = url('/reset-password/' . $verificationCode . '?user=' . urlencode($user->id));

            $user->update(['verification_code' => $verificationCode]);
            $data = [
                'name' => $user->first_name,
                'email' => $request->email,
                'verification_link' => $verificationLink,
                'type' => "forgotPasswordLink"
            ];
            try {
                SendRegistrationEmail::dispatch($data);

            } catch (\Throwable $th) {
                \Log::error('Email queuing failed: ' . $th->getMessage());
            }

        }


        // dd($user);
        // $email = $request->input('email');
        // $emailExists = User::where('email', $email)->exists();

        // return response()->json(['valid' => $emailExists]);
    }
    public function resetPassword(Request $request, $verificationCode)
{
    // Retrieve user ID from query parameter
        $userId = (int) $request->query('user');



    // Debugging: Check if userId is received
    // if (!$userId) {
    //     dd('User ID not found in query parameters.');
    // }

    // Fetch user based on ID and verification code
    $user = User::where('id', $userId)
                ->where('verification_code', $verificationCode)
                ->first();

    // Debugging: Check if user is found
    if ($user) { // This will dump user data
        return view('auth.passwordResetForm', compact('userId', 'verificationCode'));
    } else {
        dd('Invalid verification link or user not found.');
    }
    }
     function forgotPasswordForm()
        {
            return view('auth.forgotpassword');
        }

    public function resetPasswordAction(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
            'userId' => 'required',
            'verificationCode' => 'required',
        ]);

        $user = User::where('id', $request->userId)
                    ->where('verification_code', $request->verificationCode)
                    ->first();

        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Invalid verification link or user not found.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
            'verification_code' => null, // Clear verification code after reset
        ]);

        return response()->json(['status' => 'success', 'message' => 'Password has been successfully reset!']);
    }

}


