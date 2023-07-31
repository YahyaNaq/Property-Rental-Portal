<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $guarded = ['category'];

    public function scopeFilter($query, $filters)
    {
        if (($filters['search'] ?? false) && $filters['search']) {
            return $query->where('title', 'like', '%' . $filters['search'] . '%');
        }
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function views()
    {
        return $this->hasMany(View::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    
}
