<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RejectedOffer extends Model
{
    use HasFactory;

    protected $table='rejected_offers_log';
}
