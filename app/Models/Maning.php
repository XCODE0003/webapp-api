<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maning extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'datetime_end',
        'claimed',

    ];

    protected $casts = [
        'datetime_end' => 'datetime',
    ];
}
