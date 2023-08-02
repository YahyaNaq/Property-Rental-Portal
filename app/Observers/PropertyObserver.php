<?php

namespace App\Observers;

use App\Models\Property;
use App\Models\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class PropertyObserver
{
    /**
     * Handle the Property "created" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function retrieved(Property $property)
    {
        $data=['username' => $property->agent->username, 'id' => $property->id];

        if 
        (Auth::user()
        && url()->current()==route('properties.show', $data)
        && !(View::where('property_id', $property->id)
                ->where('user_id', Auth::id())->first()))
        {
            View::create([
                'user_id' => Auth::id(),
                'property_id'=> $property->id,
            ]);
        }
    }

    /**
     * Handle the Property "created" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function created(Property $property)
    {
        //
    }
    
    /**
     * Handle the Property "creating" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function creating(Property $property)
    {
        $agent=$property->agent;
        $agent->update(['properties_uploaded' => $agent->properties_uploaded+1]);
    }

    /**
     * Handle the Property "updated" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function updated(Property $property)
    {
        if
        ($property->isDirty('is_rented')
        && $property->getOriginal('is_rented') != $property->is_rented) 
        {
            $agent=$property->agent;
            $agent->update(['properties_rented' => $agent->properties_rented+1]);
        }
    }

    /**
     * Handle the Property "deleted" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function deleted(Property $property)
    {
        //
    }

    /**
     * Handle the Property "restored" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function restored(Property $property)
    {
        //
    }

    /**
     * Handle the Property "force deleted" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function forceDeleted(Property $property)
    {
        //
    }
}
