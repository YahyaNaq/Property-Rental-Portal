<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function index($username)
    {
        $user=User::where('username', $username)->first();

        if(!$user) abort(404, 'User not found');
        return view('profile.index', compact('user'));  
    }
}
