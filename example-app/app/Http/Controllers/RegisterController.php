<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Hello;
use Illuminate\Support\Str;
use App\Mail\ChangePassWordMail;

//use App\Mail;
class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate request data
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'usertype' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create new user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'usertype' => $request->usertype,
        ]);

        // Redirect with a success message
        return redirect()->intended('/user/homepage')->with('status', 'registration_success');
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed
            $user = Auth::user();

            if ($user->usertype != 1) {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('user.homepage');
            }
        }

        return redirect('/login')->with('error', 'Thông tin đăng nhập không chính xác');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('user.homepage');
    }

    public function forgetPass()
    {
        return view('auth.forgetPass');
    }

    public function postForgetPass(Request $req)
    {
        // Validate input email
        $req->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);

        // Generate random password
        $newPassword = Str::random(8); // Generate random 8-character password

        // Find user by email
        $user = User::where('email', $req->email)->first();

        // Update user's password in database
        $user->password = Hash::make($newPassword);
        $user->save();

        // Send new password to user via email
        Mail::send('emails.check_email_forget', ['user' => $user, 'newPassword' => $newPassword], function ($email) use ($user) {
            $email->subject('Mật khẩu mới');
            $email->to($user->email, $user->name);
        });

        // Redirect back with success message
        return redirect()->back()->with('password_generated', 'Mật khẩu mới đã được gửi vào email của bạn.');
    }


}
