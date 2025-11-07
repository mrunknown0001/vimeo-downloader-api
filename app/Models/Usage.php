<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usage extends Model
{
    protected $fillable = [
        'user_id', 'point',
        'ip_address', 'domain',
    ];
    protected static function booted(): void
    {
        static::creating(function (Usage $usage) {
            $usage->ip_address = request()->ip();
        });
    }
}
