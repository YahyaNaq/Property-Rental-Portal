<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $property = Property::where('user_id', Auth::id())->first();
    
        return view('dashboard.index', compact('property'));
    }

    public function offers_list()
    {
        $offers = Offer::where('is_pending', true)->where('user_id', Auth::id())->get();
    
        return view('dashboard.offers_list', compact('offers'));
    }
}
