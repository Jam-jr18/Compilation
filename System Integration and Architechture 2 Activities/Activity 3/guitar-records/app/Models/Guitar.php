<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guitar extends Model
{
    // These names MUST match your database column names exactly
    protected $fillable = ['brand', 'model', 'type', 'year', 'price'];
}