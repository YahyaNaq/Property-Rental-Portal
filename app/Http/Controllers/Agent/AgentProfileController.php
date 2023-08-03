<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentProfileController extends Controller
{
    public function index($username)
    {
        $user=Agent::where('username', $username)->first();

        if(!$user) abort(404, 'User not found');
        return view('agent.profile.index', compact('user'));  
    }
}
