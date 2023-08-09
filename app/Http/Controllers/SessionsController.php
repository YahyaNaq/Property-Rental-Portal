<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
