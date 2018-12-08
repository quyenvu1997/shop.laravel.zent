<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'price_sales','description','quanlity','category_id','slug'
    ];
    public function images()
    {
        return $this->hasMany('App\ProductImage');
    }
    public function attributes(){
    	return $this->belongsToMany('App\Attribute', 'values', 'product_id', 'attribute_id')->withPivot('value');
    }
    public function orders(){
        return $this->belongsToMany('App\Order', 'order_details', 'product_id', 'order_id')->withPivot('quanlity','price');
    }
    public static function updateData($id,$data){
        $product=Product::find($id);
        $product->name=$data['name'];
        $product->price=$data['price'];
        $product->price_sales=$data['price_sales'];
        $product->description=$data['description'];
        $product->quanlity=$data['quanlity'];
        $product->category_id=$data['categories'];
        $product->slug=implode("-", explode(" ",implode("-", explode("/",$data['name']))));
        $product->save();
        return $product;
    }
}
