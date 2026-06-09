<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RestaurantTable extends Model
{
    protected $fillable = ['name', 'capacity', 'status'];

    protected $casts = [
        'capacity' => 'integer',
    ];
}
