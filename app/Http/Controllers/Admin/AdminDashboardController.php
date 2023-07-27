<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', Auth::guard('admins')->id())->get();
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
}
