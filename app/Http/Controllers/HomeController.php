<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::where('is_rented', false)->get();
        return view('index', [
            'properties' => $properties
        ]);
    }

    public function show($id)
    {
        $property = Property::where('id', $id)->first();
        return view('show', [
            'property' => $property
        ]);
    }

}
