<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Attribute;
use App\Value;
use Yajra\Datatables\Datatables;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.listproduct');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name=$request->name;
        $slug=implode("-", explode(" ",implode("-", explode("/",$name))));
        $product=Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'price_sales'=>$request->price_sales,
            'description'=>$request->description,
            'quanlity'=>$request->quanlity,
            'category_id'=>$request->categories,
            'slug'=>$slug,
        ]);
        $attributes=Attribute::all();
        foreach ($attributes as $attribute) {
            $att=$attribute->id;
            if (($request->$att)!=null) {
                Value::create([
                    'product_id'=>$product->id,
                    'attribute_id'=>$attribute->id,
                    'value'=>$request->$att,
                ]);
            }
        }
        return redirect('/admin/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //dd(Product::find($id)->attributes);
        return response()->json([
            'product'=>Product::find($id),
            'image'=>Product::find($id)->images->first()['link'],
            'attributes'=>Product::find($id)->attributes,
        ]);
        // return Product::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view('admin.product.edit',['product'=>$product]);
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
        $product=Product::updateData($id,$request->all());
        $values=Value::where('product_id',$id)->get();
        foreach ($values as $value) {
            Value::find($value->id)->delete();
        }
        $attributes=Attribute::all();
        foreach ($attributes as $attribute) {
            $att=$attribute->id;
            if (($request->$att)!==null) {
                Value::create([
                    'product_id'=>$product->id,
                    'attribute_id'=>$attribute->id,
                    'value'=>$request->$att,
                ]);
            }
        }
        return redirect('/admin/products'); 
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
    public function getdata()
    {
        // dd(Product::query());
        return Datatables::of(Product::query())
            ->addColumn('action', function ($product) {
                return '<button type="" class="btn btn-sm btn-info fa fa-eye" data-toggle="modal" href="#modal-show" data-id="'.$product->id.'"></button>
                <a href="/admin/products/'.$product->id.'/edit" class="btn btn-warning fa fa-edit text-white"></a>  
                ';
            })
            // <button data-id="'.$product->id.'" class="btn btn-danger fa fa-trash-alt"></button>
            ->addColumn('image', function ($product) {
                return '<img src="'.$product->images->first()->link.'" alt="" style="wight:50px; height:50px;">';
                return $product->images->first()->link;
            })
            ->editColumn('price', function ($product) {
                if ($product->price_sales!=0) {
                    return number_format($product->price_sales);
                }else{
                    return number_format($product->price);
                }
                
            })
            ->rawColumns(['image','action'])
            ->make(true);
    }
}
