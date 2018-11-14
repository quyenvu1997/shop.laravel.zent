<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(Request $request, $id)
    {
        //
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
    public function detail($slug){
        $product=\App\Product::where('slug','=',$slug)->first();
        return view('users.detailproduct',['product'=>$product]);
    }
    public function search(Request $request){
        $category= $request->categories;
        $key=$request->key;
        if ($category==0) {
            $products=Product::where('name','like','%'.$key.'%')
            ->orwhere('description','like','%'.$key.'%')
            ->paginate(12);
            return view('users.searchs',['products'=>$products, 'key' => $key]);
        }else {
            $products=Product::where('category_id','=',$category)
            ->where(function ($query) {
                $query->where('name','like','%'.$key.'%')
                      ->orWhere('description','like','%'.$key.'%');
            })
            ->paginate(12);
            dd($products);
            return view('users.searchs',['products'=>$products, 'key' => $key]);
        }
    }
}
