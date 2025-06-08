<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'google_id',
        'brand',
        'model',
        'year',
        'price_per_month',
        'fuel',
        'transmission',
        'segment',
        'specs',
        'images',
        'slug',
    ];
}
