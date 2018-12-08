<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'code', 'name', 'email', 'mobile', 'address', 'payment_id', 'status_id', 'user_id','tong_tien', 'notes',
    ];
    public function status(){
        return $this->belongsTo('App\Status');
    }
    public function payment(){
        return $this->belongsTo('App\PayMent');
    }
    public function products(){
    	return $this->belongsToMany('App\Product', 'order_details', 'order_id', 'product_id')->withPivot('quanlity','price');
    }
}
