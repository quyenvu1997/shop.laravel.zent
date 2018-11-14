<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Value extends Model
{
    protected $fillable = [
        'product_id', 'attribute_id', 'value',
    ];
}
