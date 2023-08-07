<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AdminSessionsController extends Controller
{
    
    public function create()
    {
        return view('admin.sessions.create');
    }


    public function store(Request $request)
    {
        $data=$request->validate([
            'email' => ['required', 'email', Rule::exists('admins','email')],
            'password' => ['required']
        ]);

        $remember = boolval($request->input('remember-me')) ?? false; 

        if (Auth::guard('admins')->attempt($data, $remember)) {  
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
