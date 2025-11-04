<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name', 'description', 'points_per_month', 'is_active', 'request_per_second',
        'price',
    ];
}
