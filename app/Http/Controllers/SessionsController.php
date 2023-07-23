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
        // Query: Why isn't the code halting here in the case of failed validation as it does in a failed
        // created of new user or property.
        $data=$request->validate([
            'email' => ['required', 'email', Rule::exists('users','email')],
            'password' => ['required']
        ]);

        if (Auth::attempt($data)) {
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

        return redirect('/');
    }
}
