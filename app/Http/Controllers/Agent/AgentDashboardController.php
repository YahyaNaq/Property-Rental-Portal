<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
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

    public function offers_list()
    {
        $properties = Agent::find(Auth::guard('agents')->id())->properties->where('is_verified', true);
        // dd($properties);
        $offers= $properties->filter(function ($property) {
            return $property->offers->isNotEmpty();
        });
        return view('agent.dashboard.offers_list', compact('properties', 'offers'));
    }
}
