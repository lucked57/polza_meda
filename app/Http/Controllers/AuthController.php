<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showRegister ()
    {
        return view("auth.register");
    }

    public function showLogin ()
    {
        return view("auth.login");
    }

    public function showResetPass ()
    {
        return view("auth.resetpass");
    }
    public function register (Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed|max:255',
        ]);

        $user = User::create($validated);

        $verificationCode = rand(100000, 999999);
        $message = "Please visit this link to register your account: " . url('register/'. $user->id . '/' . $verificationCode);
        $message = wordwrap($message, 70, "\r\n");
        if(mail($user->email, 'Registration', $message)){
                $hashedCode = Hash::make($verificationCode);
                $user->email_verification_code = $hashedCode;
        }
            
            $user->message_to_email = url('register/'. $user->id . '/' . $verificationCode);
            $user->save();

        return "Please check your email to finish registration";

        //Auth::login($user);
        //Auth::login($user, $remember = true);

        //return redirect()->route('home');
    }

    public function verifyRegistrationCode($id, $code)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'User not found.');
        }

        if(empty(trim($user->email_verification_code))){
            return response()->json([
                'message' => 'This link is not valid anymore, your email has been verified, now you can log in',
            ], 400);
        }

        if (!Hash::check($code, $user->email_verification_code)) {
            return response()->json([
                'message' => 'Invalid verification code.',
            ], 400);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null;
        $user->message_to_email = null;
        $user->save();

        Auth::login($user, true);
        session()->regenerate();

        return redirect()->route('home')->with('message', 'Email verified successfully!');
    }


    public function verifyResetPassCode($id, $code)
    {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'User not found.');
        }

        if (empty(trim($user->email_verification_code))) {
            return response()->json([
                'message' => 'This link is not valid anymore, your password has been changed, now you can log in',
            ], 400);
        }

        if (!Hash::check($code, $user->email_verification_code)) {
            return response()->json([
                'message' => 'Invalid verification code.',
            ], 400);
        }

        $newPasswordGenerated = Str::random(10);
        $user->password = Hash::make($newPasswordGenerated);
        $user->email_verification_code = null;
        //$user->is_locked = 0;
        $user->failed_lockouts = 0; 
        $user->save();

        $message = "Your new password is: " . $newPasswordGenerated;

        if (mail($user->email, 'New Password', $message)) {
            Auth::login($user, true);
            session()->regenerate();

            return redirect()->route('home')->with('message', 'New password has been sent to your email!');
        } else {
            return response()->json(['error' => 'Error with sending email'], 500);
        }
    }


    public function UpdatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required|string|max:255|min:8',
            'password' => 'required|string|min:8|confirmed|max:255',
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'Invalid current password.',
            ]);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        session()->regenerate();

        return "Password has been updated";
    }

    public function SendNewPass(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'No account found with this email.',
            ]);
        }

        if ($user && $user->is_locked && $user->is_blocked_by_admin) {
            return response()->json([
                "message" => "Your account has been locked by admin. Please contact admin",
                "errors" => [
                    "email_verification" => [
                        "Your account has been locked by admin. Please contact admin"
                    ]
                ]
            ], 422);
        }
        if ($user && $user->is_locked) {
            return response()->json([
                "message" => "Your account has been locked by admin. Please contact admin",
                "errors" => [
                    "email_verification" => [
                        "Your account has been blocked. Please contact support"
                    ]
                ]
            ], 422);
        }

        if (!empty(trim($user->email_verification_code))) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "email_verification" => [
                        "A verification code has been sent to your email. Please check your spam if you can't find the message."
                    ]
                ]
            ], 422);
        }

        $verificationCode = rand(100000, 999999);
        $message = "Please visit this link to generate new password for your account: " . url('resetpass/'. $user->id . '/' . $verificationCode);
        $message = wordwrap($message, 70, "\r\n");
        if(mail($user->email, 'Reset Password', $message)){
                $hashedCode = Hash::make($verificationCode);
                $user->email_verification_code = $hashedCode;
        }
            

            $user->save();



        return "The link has been send your email. Please check your email";
    }

    public function verifyEmailCode(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|String',
            'verification_code' => 'required|string',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'No account found with this email.',
            ]);
        }
        if (!Hash::check($validated['password'], $user->password)) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "password" => [
                        "Invalid password."
                    ]
                ]
            ], 422);
        }

        if (!Hash::check($validated['verification_code'], $user->email_verification_code)) {
            return response()->json([
                "message" => "The given data was invalid.",
                "errors" => [
                    "verification_code" => [
                        "Invalid verification code."
                    ]
                ]
            ], 422);
        }

        $user->email_verified_at = now();
        $user->email_verification_code = null; 
        $user->failed_lockouts = 0; 
        $user->save();

        // Manually log in the user
        Auth::login($user);
        $request->session()->regenerate();

        return response()->json([
            "message" => "Email verified successfully!",
            "redirect" => route('home')
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Check if user exists
        $user = User::where('email', $request->email)->first();

        if ($user && $user->is_locked && $user->is_blocked_by_admin) {
            return response()->json([
                "message" => "Your account has been locked by admin. Please contact admin",
                "locked" => true
            ], 406);
        }

        // If user is locked, prevent login
        if ($user && $user->is_locked) {
            return response()->json([
                "message" => "Your account is locked. Please reset your password or contact support.",
                "locked" => true
            ], 403);
        }

        if(!empty(trim($user->email_verification_code))){
                return response()->json([
                    "message" => "A verification code has been sent to your email. Please check your spam if you can't find message",
                    "email_verification_required" => true
                ], 405);
            }

        if (Auth::attempt($validated, true)) {
            if ($user) {
                $user->failed_lockouts = 0;
                $user->message_to_email = null;
                $user->save();
            }

            $request->session()->regenerate();
            return response()->json(['redirect' => route('home')]);
        }

        

        if ($user) {
            $user->failed_lockouts += 1;
            
            if ($user->failed_lockouts >= 10) {
                //$user->is_locked = true;
                $verificationCode = rand(100000, 999999);
                $message = "This is your verification code: ". $verificationCode. " You can also visit this link if you forget the password: " . url('resetpass/'. $user->id . '/' . $verificationCode);
                        $message = wordwrap($message, 70, "\r\n");
                        if(mail($user->email, 'Verification code', $message)){
                            $hashedCode = Hash::make($verificationCode);
                            $user->email_verification_code = $hashedCode;
                        }
            }

            $user->save();

            

            
        }

        throw ValidationException::withMessages([
            'credentials' => 'Sorry, incorrect credentials',
        ]);
    }


    public function logout (Request $request)
    {
       Auth::logout();

       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect()->route('show.login');
    }
}
