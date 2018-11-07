<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     protected $fillable = [
        'name', 'price', 'price_sales','description','amount'
    ];
}
