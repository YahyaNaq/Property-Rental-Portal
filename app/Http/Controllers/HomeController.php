<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $properties = Property::where('is_rented', false)->orderByDesc('created_at');

        return view('index', [
            'properties' => $properties->filter(request(['search']))->paginate(5)
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
