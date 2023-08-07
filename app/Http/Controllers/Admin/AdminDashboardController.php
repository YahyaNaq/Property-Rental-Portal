<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Agent\PropertyController;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        $users = Agent::all();
    
        $noOfPropsRented = $users->sum('properties_rented') ?? 0;
        $noOfPropsUp = $users->sum('properties_uploaded') ?? 0;
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

    public function verify_property(Request $request)
    {
        Property::where('id', intval($request['id']))->update(['is_verified' => true]);
    }

    public function reject_property(Request $request)
    {
        Property::where('id', intval($request['id']))->delete();
    }

    public function accept_offer(Request $request)
    {
        $offer=Offer::where('property_id', intval($request['id']))->first();
                $offer->update([
                    'is_pending' => false,
                    'accepted_at_amount' => $offer['amount_offered']
                ]);
    }

    public function reject_offer(Request $request)
    {
        Offer::where('property_id', intval($request['id']))->delete();
    }

    public function offers_list()
    {
        $offers = Offer::where('is_pending', true)->get();

        $properties = Property::where('is_rented', false)->get();
    
        return view('admin.dashboard.offers_list', compact('offers', 'properties'));
    }

    public function confirm_password_edit(Request $request)
    {
        $data=$request->all();
        $pwd_original= Auth::guard('admins')->user()->password;

        if (!Hash::check($data['password'], $pwd_original)) {
            return response()->json(['error' => 'Invalid password'], 422);
        }

        $url = route('properties.edit', [ 'username' => $data['username'], 'id' => $data['id']]);

        return response()->json(['url' => $url], 200);
    }
}
