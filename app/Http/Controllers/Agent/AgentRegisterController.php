<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AgentRegisterController extends Controller
{
    public function create()
    {
        return view('agent.register.create');
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

        Agent::create($data);

        session()->flash('success', 'New agent account has been created.');

        return redirect('/admin/dashboard/agents');
    }
}
