<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AgentSessionsController extends Controller
{
    public function create()
    {
        return view('agent.sessions.create');
    }

    public function store(Request $request)
    {
        // Query: Why isn't the code halting here in the case of failed validation as it does in a failed
        // created of new user or property.
        $data=$request->validate([
            'email' => ['required', 'email', Rule::exists('agents','email')],
            'password' => ['required']
        ]);

        if (Auth::guard('agents')->attempt($data)) {
            session()->flash('success', 'Logged in');
            return redirect('/agent/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => "Email or password is incorrect"
        ]);
    }

    public function destroy()
    {
        Auth::guard('agents')->logout();
        session()->flash('success', 'Logged out');

        return redirect(route('agent.login'));
    }
}
