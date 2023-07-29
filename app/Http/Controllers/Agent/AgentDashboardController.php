<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class AgentDashboardController extends Controller
{
    public function index()
    {
        $properties = Property::where('agent_id', Auth::guard('agents')->id())->get();
        $user = Auth::guard('agents')->user();
    
        $noOfPropsRented = $user->properties_rented ?? 0;
        $noOfPropsUp = $user->properties_uploaded ?? 0;
        $noOfPropsCurrentlyUp = $properties->count();
        $noOfPropsCurrentlyRented = $properties->where('is_rented', true)->count();
    
        return view('agent.dashboard.index', compact(
            'properties',
            'noOfPropsUp',
            'noOfPropsRented',
            'noOfPropsCurrentlyUp',
            'noOfPropsCurrentlyRented'
        ));
    }
}
