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
        $data=['username' => $property->user->username, 'id' => $property->id];

        if 
        (Auth::user()
        && url()->current()==route('properties.show', $data)
        && Auth::id()!=$property->user_id
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
        $user=$property->user;
        $user->update(['properties_uploaded' => $user->properties_uploaded+1]);
    }

    /**
     * Handle the Property "updated" event.
     *
     * @param  \App\Models\Property  $property
     * @return void
     */
    public function updated(Property $property)
    {
        //
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
