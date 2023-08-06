<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\RejectedProperty;
use App\Observers\PropertyObserver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::where('is_rented', false)->where('is_verified', true)->orderByDesc('created_at');

        if(Auth::guard('agents')->check()) {
            return view('agent.index', [
                'properties' => $properties->filter(request(['search']))->paginate(8)
            ]);
        }
        elseif(Auth::guard('admins')->check()) {
            return view('admin.index', [
                'properties' => $properties->filter(request(['search']))->paginate(8)
            ]);
        }
        else {
            return view('index', [
                    'properties' => $properties->filter(request(['search']))->paginate(8)
                ]);
            }
    }

    public function show($id)
    {
        $property = Property::where('id', $id)->first();
        return view('show', [
            'property' => $property
        ]);
    }

}
