<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'energy',
        'energy_max',
        'energy_tap',
        'collected',
        'last_tap'



    ];

    protected $casts = [
        'last_tap' => 'datetime',
        'collected' => 'boolean',
        'energy' => 'float',
        'energy_max' => 'integer',
    ];
}
