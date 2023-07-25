<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PropertyController extends Controller
{
    protected function getValidationRules()
    {
        return [
            'title' => ['required', 'min:20', 'max:50'],
            'description' => ['required', 'min:100', 'max:1000'],
            'category' => ['required', 'min:4', 'max:25'],
            'city' => ['required', 'min:3', 'max:25'],
            'location' => ['required', 'min:4', 'max:25'],
            'area' => ['required'],
            'monthly_rent' => ['required', 'integer', 'between:10000,1000000000'],
            'bedrooms' => ['required', 'min:1', 'max:10'],
            'bathrooms' => ['required', 'integer', 'between:1,10'],
        ];
    }

    protected function getAttributes()
    {
        return [
            'monthly_rent' => 'rent'
        ];
    }
    
    public function index($username)
    {
        $properties = Property::where('user_id', Auth::id())->orderByDesc('updated_at');

        return view('properties.index', [
            'properties' => $properties->filter(request(['search']))->get(),
            'username' => $username
        ]);
    }

    public function create()
    {
        return view('properties.create', [
            'categories' => Category::pluck('name')
        ]);
    }

    public function edit($username, $id)
    {
        $property = Property::findOrFail($id);

        if (! Gate::allows('edit-property', $property)) {
            abort(403);
        }
        return view('properties.edit')
                ->with('property', $property)
                ->with('username', $username)
                ->with('categories', Category::pluck('name'));
    }

    public function delete($username, $id)
    {
        $property = Property::findOrFail($id);

        if (! Gate::allows('delete-property', $property)) {
            abort(403);
        }

        return view('properties.delete', compact('property','username'));
    }


    public function store(Request $request, $username)
    {   
        $rules= $this->getValidationRules();
        $rules['title'][] = Rule::unique('properties','title');

        $data = $request->all();
        $data['user_id']=Auth::id();
        $data['category_id']=Category::where('name', $data['category'])->first()->id;

        Validator::make($data, $rules, [], $this->getAttributes())->validate();

        Property::create($data);
        
        session()->flash('success', 'New rental property added');
        
        return redirect("/$username/properties");
    }

    public function update(Request $request, $username, $id)
    {   
        $property = Property::findOrFail($id);
        
        if (! Gate::allows('edit-property', $property)) {
            abort(403);
        }

        $data = $request->all();
        $data['category_id']=Category::where('name', $data['category'])->first()->id;

        $validator=Validator::make($data, $this->getValidationRules(), [], $this->getAttributes());
        if ($validator->fails()) {
            return redirect("/$username/properties/edit/$id")
                    ->withErrors($validator)
                    ->withInput();
        }

        $property->update($data);

        session()->flash('success', 'Rental property updated');
        
        return redirect("/$username/properties");
    }
    
    public function show(Request $request, $username, $id)
    {
        $property = Property::findOrFail($id);
    
        return view('properties.show', compact('property'));

    }

    public function destroy(Request $request, $username, $id)
    {
        $property = Property::findOrFail($id);
        
        if (! Gate::allows('delete-property', $property)) abort(403);

        $data = $request->all();
        $data['original_title']= $property['title'];
        $rules= [
            'title' => ['required', 'same:original_title']
        ];
        $messages = [
            'same' => 'Entered title must match the property title'
        ];

        $validator=Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect("$username/properties/delete/$id")
                    ->withErrors($validator)
                    ->withInput();
        }

        $property->delete();

        session()->flash('success', 'Rental property deleted.');

        return redirect("/$username/properties");
    }
}