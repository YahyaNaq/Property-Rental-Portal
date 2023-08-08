<?php

namespace App\Http\Controllers;

use App\Mail\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'email' => ['required', 'email', Rule::exists('users','email')],
            'password' => ['required']
        ]);

        $remember = boolval($request->input('remember-me')) ?? false; 

        if (Auth::attempt($data, $remember)) {
            session()->flash('success', 'Logged in.');
            return redirect('/');
        }

        throw ValidationException::withMessages([
            'email' => "Email or password is incorrect"
        ]);
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', 'Logged out.');

        return redirect(route('login'));
    }

    public function forgot_password(Request $request) 
    {     
        $validator=Validator::make($request->all(), ['email' => 'required|email|exists:users']);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->get('email')], 422);
        }
        
        $token = Str::random(64);
        $email = $request->input('email');

        Mail::to($email)->send(new PasswordReset($token));

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token, 
            'created_at' => now()
        ]);
        
        $url = route('email.sent', ['email' => $email]);
        return response()->json(['url' => $url], 200);
    }
}
