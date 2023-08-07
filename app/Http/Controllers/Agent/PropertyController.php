<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Location;
use App\Models\Offer;
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
            'title' => ['required', 'min:25', 'max:100'],
            'description' => ['required', 'min:150', 'max:1500'],
            'category' => ['required', 'min:4', 'max:25'],
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
        $properties = Property::where('agent_id', Auth::guard('agents')->id())->orderByDesc('updated_at');

        return view('agent.properties.index', [
            'properties' => $properties->filter(request(['search']))->paginate(5),
            'username' => $username
        ]);
    }

    public function show(Request $request, $username, $id)
    {
        $property = Property::findOrFail($id);

        if (Auth::guard('agents')->check()) {
            return view('agent.properties.show', compact('property', 'username'));
        } elseif (Auth::guard('admins')->check()) {
            return view('admin.properties.show', compact('property', 'username'));
        } else {
            return view('properties.show', compact('property', 'username'));
        }
    }

    public function create($username)
    {
        return view('agent.properties.create', [
            'username' => $username,
            'categories' => Category::pluck('name'),
            'locations' => Location::all(['city_id','name'])
        ]);
    }

    public function store(Request $request, $username)
    {
        $rules = $this->getValidationRules();
        $rules['title'][] = Rule::unique('properties', 'title');
        
        $data = $request->all();
        $data['agent_id'] = Auth::guard('agents')->id();
        $data['category_id'] = Category::where('name', $data['category'])->first(['id'])->id;
        $data['location_id'] = Location::where('name', $data['location'])->first(['id'])->id;
        
        Validator::make($data, $rules, [], $this->getAttributes())->validate();
        
        Property::create($data);
        
        session()->flash('success', 'New rental property added');

        return redirect("/$username/properties");
    }

    public function edit($username, $id)
    {
        $property = Property::findOrFail($id);

        if (Auth::guard('agents')->check()) {
            if ($username!=$property->agent->username) {
                abort(403);
            }
        }
        
        return view('agent.properties.edit')
        ->with('property', $property)
        ->with('username', $username)
        ->with('categories', Category::pluck('name'))
        ->with('locations', Location::all(['city_id','name']));
    }
    
    public function update(Request $request, $username, $id)
    {
        $property = Property::findOrFail($id);
        
        if (Auth::guard('agents')->check()) {
            if ($username!=$property->agent->username) {
                abort(403);
            }
        }
        
        $data = $request->all();
        $data['category_id'] = Category::where('name', $data['category'])->first(['id'])->id;
        $data['location_id'] = Location::where('name', $data['location'])->first(['id'])->id;
        
        $validator = Validator::make($data, $this->getValidationRules(), [], $this->getAttributes());
        if ($validator->fails()) {
            return redirect("/$username/properties/edit/$id")
                ->withErrors($validator)
                ->withInput();
        }

        $property->update($data);

        session()->flash('success', 'Rental property updated');

        return redirect("/$username/properties");
    }

    public function delete($username, $id)
    {
        $property = Property::findOrFail($id);

        if (Auth::guard('agents')->check()) {
            if ($username!=$property->agent->username) {
                abort(403);
            }
        }

        return view('agent.properties.delete', compact('property', 'username'));
    }

    public function destroy(Request $request, $username, $id)
    {
        $property = Property::findOrFail($id);

        if (Auth::guard('agents')->check()) {
            if ($username!=$property->agent->username) {
                abort(403);
            }
        }

        $data = $request->all();
        $data['original_title'] = $property['title'];
        $rules = [
            'title' => ['required', 'same:original_title']
        ];
        $messages = [
            'same' => 'Entered title must match the property title'
        ];

        $validator = Validator::make($data, $rules, $messages);

        if ($validator->fails()) {
            return redirect("$username/properties/delete/$id")
                ->withErrors($validator)
                ->withInput();
        }

        $property->delete();

        session()->flash('success', 'Rental property deleted.');

        return redirect("/$username/properties");
    }

    public function createOffer($username, $id)
    {
        $property = Property::findOrFail($id);

        return view('agent.properties.make-offer', compact('property', 'username'));
    }

    public function storeOffer(Request $request, $username, $id)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['property_id'] = $id;

        Validator::make($data, [
            'offer_amount' => ['integer', 'required'],
            'message' => ['required', 'max:50', 'max:300']
        ])->validate();

        $data['amount_offered'] = $data['offer_amount'];
        unset($data['offer_amount']);

        Offer::updateOrCreate(
            ['user_id' => $data['user_id'], 'property_id' => $data['property_id']],
            ['message' => $data['message'], 'amount_offered' => $data['amount_offered']]
        );

        session()->flash('success', 'Offer sent');

        return redirect("/dashboard/offers-made");
    }
}
