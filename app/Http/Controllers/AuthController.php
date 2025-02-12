<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Mail;
use Str;

class AuthController extends Controller
{
    public function login(){
        return view('Admin.auth.login');
    }

    public function post(Request $request){
        $crendentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::attempt($crendentials)){
            return redirect()->route('admindashboard');
        }
        return back()->with('error', 'Incorrect User details');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function forgot(){
        return view('Admin.auth.forgotpassword');
    }

    public function reset($token){
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user)){
            $data['user'] = $user;
            return view('Admin.auth.resetpassword', $data);
        }
        else{
            abort(404);
        }
    }

    public function post_reset($token, Request $request){
        $user = User::where('remember_token', '=', $token)->first();
        if(!empty($user)){
            if($request->password == $request->cpassword){
                $user->password = Hash::make($request->password);
                if(empty($user->email_verified_at))
                {
                    $user->email_verified_at = date('Y-m-d H:i:s');
                }
                $user->remember_token = Str::random(40);
                $user->save();
                return redirect()->route('login')->with('success', "password updated successfully!");
            }
            else{
                return redirect()->back()->with('error', "password mismatch!");
            }
        }
        else{
            abort(404);
        }
    }

    public function forgot_password(Request $request){
        $user = User::where('email', '=', $request->email)->first();
        if(!empty($user)){
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new ForgotPasswordMail($user));
            return redirect()->back()->with('success', "Email sent successfully! Check your mail inbox.");
        }
        else{
            return redirect()->back()->with('error', "This email does not exist!");
        }
    }
}
