<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{

    public function index($username)
    {
        $user=Admin::where('username', $username)->first();

        if(!$user) abort(404, 'User not found');
        return view('admin.profile.index', compact('user'));  
    }
}
