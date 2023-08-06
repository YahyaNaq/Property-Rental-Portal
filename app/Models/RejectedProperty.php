<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedProperty extends Model
{
    use HasFactory;

    protected $table='rejected_properties_log';

    protected $guarded = [];
}
