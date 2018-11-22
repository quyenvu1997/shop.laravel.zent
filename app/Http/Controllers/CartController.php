<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
//use Gloudemans\Shoppingcart\ShoppingcartServiceProvider;
use Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
        $product=Product::find($id);
        Cart::add($id,$product->name,1,isset($product->price_sales)?$product->price_sales:$product->price);
        return response()->json([
            'subtotal'=>Cart::subtotal(),
            'qty_cart'=>Cart::count(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rowId=request()->rowid;
        $status=request()->status;
        $product=Cart::get($rowId);
        $number=$product->qty;
        if ($number==1&&$status=='-1') {
            Cart::remove($rowId);
            return response()->json([
                'delete'=>'true',
                'subtotal'=>Cart::subtotal(),
                'qty_cart'=>Cart::count(),

            ]);
        }
        // $kho=Product::find($id)
        // if ($number==1&&$status=='-1') {
        //     # code...
        // }
        Cart::update($rowId,$number+$status);
        return response()->json([
            'rowId'=>Cart::get($rowId),
            'subtotal'=>Cart::subtotal(),
            'qty_cart'=>Cart::count(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function delete(Request $request){
        $rowId=request()->rowId;
        Cart::remove($rowId);
        return response()->json([
            'subtotal'=>Cart::subtotal(),
            'qty_cart'=>Cart::count(),
        ]);
    }
    public function checkout(){
        return view('users.checkout');
    }
}
