<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Offer;
use App\Models\Property;
use App\Models\View;
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
        $offers = Offer::where('is_pending', true)
                            ->join('properties', 'offers.property_id', 'properties.id')
                            // ->join('agents', 'agents.id', 'properties.agent_id')
                            ->where('properties.agent_id', Auth::guard('agents')->id())
                            ->select('offers.*')
                            ->get();
                            
        $properties = Property::where('agent_id', Auth::guard('agents')->id())->get();
        // dd($properties);
        return view('agent.dashboard.offers_list', compact('offers', 'properties'));
    }

    public function views_list()
    {
        $views = View::join('properties', 'views_log.property_id', 'properties.id')
                        ->where('properties.agent_id', Auth::guard('agents')->id())
                        ->select('views_log.*')
                        ->get();

        $properties = Property::where('agent_id', Auth::guard('agents')->id())->get();

        return view('agent.dashboard.views_list', compact('views', 'properties'));
    }
}
