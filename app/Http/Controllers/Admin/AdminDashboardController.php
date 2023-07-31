<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        $user = Auth::guard('admins')->user();
    
        $noOfPropsRented = $user->properties_rented ?? 0;
        $noOfPropsUp = $user->properties_uploaded ?? 0;
        $noOfPropsCurrentlyUp = $properties->count();
        $noOfPropsCurrentlyRented = $properties->where('is_rented', true)->count();
    
        return view('admin.dashboard.index', compact(
            'properties',
            'noOfPropsUp',
            'noOfPropsRented',
            'noOfPropsCurrentlyUp',
            'noOfPropsCurrentlyRented'
        ));
    }

    public function agents_list()
    {
        $agents = Agent::all();

        return view('admin.dashboard.agents_list', compact('agents'));
    }

    public function verify_properties()
    {
        $properties = Property::where('is_verified', false)->get();

        return view('admin.dashboard.verify_property', compact('properties'));
    }
}
