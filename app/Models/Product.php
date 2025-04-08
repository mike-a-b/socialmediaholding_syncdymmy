<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'external_id',
        'type',
        'title',
        'description',
        'price',
        'brand',
    ];
}
