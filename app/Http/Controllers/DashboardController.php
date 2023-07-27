<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->get();
        $user = Auth::user();
    
        $noOfPropsRented = $user->properties_rented ?? 0;
        $noOfPropsUp = $user->properties_uploaded ?? 0;
        $noOfPropsCurrentlyUp = $properties->count();
        $noOfPropsCurrentlyRented = $properties->where('is_rented', true)->count();
    
        return view('dashboard.index', compact(
            'properties',
            'noOfPropsUp',
            'noOfPropsRented',
            'noOfPropsCurrentlyUp',
            'noOfPropsCurrentlyRented'
        ));
    }
}
