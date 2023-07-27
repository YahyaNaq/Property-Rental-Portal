<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminRegisterController extends Controller
{
    public function create()
    {
        return view('admin.register.create');
    }

    public function store(Request $request)
    {   
        $data = $request->all();
        Validator::make($data, [
            'full_name' => ['required', 'min:5', 'max:255'],
            'username' => ['required', 'min:3', 'max:255', Rule::unique('users','username')],
            'email' => ['required', 'email', 'max:255', Rule::unique('users','email')],
            'password' => ['required', 'min:8', 'max:255', 'same:confirm-password'],
        ], [], [
           'confirm-password' => '*password for confirmation*' 
        ])->validate();

        $user=Admin::create($data);

        Auth::login($user);

        session()->flash('success', 'Your account has been created.');

        return redirect('/');
    }
}
