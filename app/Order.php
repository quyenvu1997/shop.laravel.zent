<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'name', 'email', 'mobile', 'address', 'payment_id', 'status_id', 'user_id', 'notes',
    ];
    public function status(){
        return $this->belongsTo('App\Status');
    }
    public function payment(){
        return $this->belongsTo('App\PayMent');
    }
}
