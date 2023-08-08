<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}
