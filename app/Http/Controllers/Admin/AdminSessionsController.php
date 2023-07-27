<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminSessionsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('guest:admins')->except('destroy');
    }

    public function guard() 
    {
        return Auth::guard('admins');
    }

    public function create()
    {
        return view('admin.sessions.create');
    }


    public function store(Request $request)
    {
        // Query: Why isn't the code halting here in the case of failed validation as it does in a failed
        // created of new user or property.
        $data=$request->validate([
            'email' => ['required', 'email', Rule::exists('admins','email')],
            'password' => ['required']
        ]);     
        if (Auth::guard('admins')->attempt($data)) {  
            session()->flash('success', 'Logged in.');
            return redirect('/admin/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => "Email or password is incorrect"
        ]);
    }

    public function destroy()
    {
        Auth::guard('admins')->logout();
        session()->flash('success', 'Logged out.');

        return redirect(route('admin.login'));
    }
}
