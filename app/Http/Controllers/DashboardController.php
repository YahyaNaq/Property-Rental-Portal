<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DashboardController extends Controller
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

    public function create()
    {
        return view('dashboard.create', [
            'categories' => Category::pluck('name')
        ]);
    }

    public function edit($id)
    {
        $property = Property::findOrFail($id);

        if (! Gate::allows('edit-property', $property)) {
            abort(403);
        }

        return view('dashboard.edit')
                ->with('property', $property)
                ->with('categories', Category::pluck('name'));
    }

    public function delete($id)
    {
        $property = Property::findOrFail($id);

        if (! Gate::allows('delete-property', $property)) {
            abort(403);
        }

        return view('dashboard.delete', compact('property'));
    }

    public function index()
    {
        $properties = Property::where('user_id', Auth::id())->get();
        return view('dashboard.index',compact('properties'));
    }
    
    public function indexAnalytics()
    {
        return view('dashboard.analytics');
    }

    public function store(Request $request)
    {   
        $rules= $this->getValidationRules();
        $rules['title'][] = Rule::unique('properties','title');

        $data = $request->all();
        $data['user_id']=Auth::id();
        $data['category_id']=Category::where('name', $data['category'])->first()->id;

        Validator::make($data, $rules, [], $this->getAttributes())->validate();

        Property::create($data);
        
        session()->flash('success', 'New rental property added.');
        
        return redirect('/');
    }

    public function update(Request $request, $id)
    {   
        $property = Property::findOrFail($id);
        
        if (! Gate::allows('edit-property', $property)) {
            abort(403);
        }

        $data = $request->all();
        $data['category_id']=Category::where('name', $data['category'])->first()->id;

        $validator=Validator::make($data, $this->getValidationRules(), [], $this->getAttributes());
        if ($validator->fails()) {
            return redirect("/dashboard/edit-a-property/$id")
                    ->withErrors($validator)
                    ->withInput();
        }

        $property->update($data);

        session()->flash('success', 'Rental property updated.');
        
        return redirect('/');
    }
    
    public function destroy(Request $request, $id)
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
            return redirect("/dashboard/delete-a-property/$id")
                    ->withErrors($validator)
                    ->withInput();
        }

        $property->delete();

        session()->flash('success', 'Rental property deleted.');

        return redirect('/');

    }
}
