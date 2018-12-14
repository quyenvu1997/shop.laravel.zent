<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use Cart;
use Illuminate\Support\Facades\Mail;
use Yajra\Datatables\Datatables;
use Auth;
use App\Product;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return view('admin.order.listorder');
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
        $order=Order::create([
            'code' =>  $request->email.'_'.date('d-m-Y_H:i:s'),
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'payment_id' => $request->payment,
            'status_id' => 5,
            'notes' => $request->notes,
            'tong_tien'=>0,
        ]);
        $tong=0;
        foreach (Cart::content() as $product) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' =>$product->id,
                'quanlity' => $product->qty,
                'price' => $product->price,
            ]);
            $sp=Product::find($product->id);
            $sp->quanlity=$sp->quanlity-$product->qty;
            $sp->save();
            $tong+=$product->qty*$product->price;
        }
        $order->tong_tien=$tong;
        $order->save();
        Cart::destroy();
        // Mail::to($email)->send(new \App\Mail\Order(3));
        return redirect('');
        // ['message'=>'Đã đặt hàng thành công']
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(Order::find($id)->products)
        return response()->json([
            'order'=>Order::find($id),
            'status'=>Order::find($id)->status->name,
            'listsp'=>Order::find($id)->products,
            // 'attributes'=>order::find($id)->attributes,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json([
            'order'=>Order::find($id),
            'status'=>Order::find($id)->status->id,
            'listsp'=>Order::find($id)->products,
            // 'attributes'=>order::find($id)->attributes,
        ]);
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
        $order=Order::find($id);
        $order->status_id=$request->status;
        $order->save();
        return response()->json([
            'order' => $order,
            'status' =>$order->status->name,
        ]);
        return $order;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rows=OrderDetail::where('order_id','=',$id)->get();
        foreach ($rows as $row) {
            $product=Product::find($row->product_id);
            $product->quanlity=$product->quanlity+$row->quanlity;
            $product->save();
            OrderDetail::find($row->id)->delete();
        }
        Order::find($id)->delete();
        return response()->json([
            'message' => 'Xóa đơn hàng thành công'
        ]);
    }
    public function getdata()
    {
        // dd(Product::query());
        return Datatables::of(Order::query())
            ->addColumn('action', function ($order) {
                if ($order->status_id==3) {
                    return '<button type="" class="btn btn-sm btn-info fa fa-eye" data-toggle="modal" href="#modal-show" data-id="'.$order->id.'" id="'.$order->id.'"></button>';
                }else{
                    return '<button type="" class="btn btn-sm btn-info fa fa-eye" data-toggle="modal" href="#modal-show" data-id="'.$order->id.'" id="'.$order->id.'"></button>
                <button type="" class="btn btn-sm btn-warning fa fa-edit text-white" data-toggle="modal" href="#modal-edit" data-id="'.$order->id.'"></button> 
                <button data_id="'.$order->id.'" class="btn btn-danger fa fa-trash-alt xoa"></button>';
                }
                
            })
            ->addColumn('status', function ($order) {
                return $order->status->name;
            })
            ->make(true);
    }
    public function listorder(){
        $orders=Order::where('user_id','=',Auth::user()->id)->get();
        return view('users.listorders',['orders'=>$orders]);
    }
}
