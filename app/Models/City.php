<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function properties()
    {
        $this->hasManyThrough(Property::class, Location::class);
    }

    public function locations()
    {
        $this->hasMany(Location::class);
    }

    public function country()
    {
        $this->belongsTo(Country::class);
    }
}
