<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
     protected $fillable = [
        'name',
    ];
    public function products(){
    	return $this->belongsToMany('App\Product', 'values', 'attribute_id', 'product_id')->withPivot('value');
    }
}
