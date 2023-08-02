<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected function user() {
        if(Auth::check()) {
            return User::class;
        }
        elseif(Auth::guard('agents')->check()) {
            return Agent::class;
        }
        elseif(Auth::guard('admins')->check()) {
            return Admin::class;
        }
    }

    public function index($username)
    {
        $user=$this->user()::where('username', $username)->first();

        if(!$user) abort(404, 'User not found');
        return view('profile.index', compact('user'));  
    }
}
