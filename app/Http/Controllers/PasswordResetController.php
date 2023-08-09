<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\PasswordReset;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PasswordResetController extends Controller
{
    public function show()
    {
        return view('password_resets.show');
    }

    public function create($token)
    {
        $email = DB::table('password_resets')->where('token', $token)->first('email')->email;

        return view('password_resets.create', [
            'email' => $email,
            'token' => $token
        ]);
    }

    public function store(Request $request, $token)
    {
        $data = $request->all();
         
        Validator::make($data, [
            'password' => ['required', 'min:8', 'max:255', 'same:confirm-password']   
        ], [], [
            'confirm-password' => '*password for confirmation*' 
        ])->validate();
            
        User::where('email', $data['email'])->update($request->only('password'));

        return redirect('/login');
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
