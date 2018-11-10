<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'price_sales','description','amount','category-id','slug'
    ];
    public function images()
    {
        return $this->hasMany('App\ProductImage');
    }
}
