<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Order;
use App\User;
use App\Category;
use App\OrderDetail;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function adminindex(){
        $numberproduct=Product::all()->count();
        $numberorder=Order::all()->count();
        $numberuser=User::all()->count();
        $numbercategories=Category::all()->count();
        $date1=date('d-m-Y');
        $listorder=Order::where('code','like','%'.$date1.'%')->get();
        $todaysale=0;
        $todaysp=0;
        foreach ($listorder as $order) {
            $todaysale+=$order->tong_tien;
            foreach ($order->products as $row) {
                $todaysp+=$row->pivot->quanlity;
            }
        }
        $date2=date('m-Y');
        $listorder2=Order::where('code','like','%'.$date2.'%')->get();
        $mounthsale=0;
        $mounthsp=0;
        foreach ($listorder2 as $order) {
            $mounthsale+=$order->tong_tien;
            foreach ($order->products as $row) {
                $mounthsp+=$row->pivot->quanlity;
            }
        }
        $listsp=array();
        foreach (OrderDetail::all() as $row) {
            if (!isset($listsp[$row->product_id])) {
                // dd($row->product_id);
                $listsp[$row->product_id]=[
                    'id'=>$row->product_id,
                    'images'=>Product::find($row->product_id)->images->first()->link,
                    'name'=>Product::find($row->product_id)->name,
                    'quanlity'=>$row->quanlity,
                ];
            }else{
                $listsp[$row->product_id]['quanlity']+=$row->quanlity;
            }
        }
        $listganhet=Product::where('quanlity','<',5)->get();
        return view('admin.home',[
            'numberproduct'=>$numberproduct,
            'numberorder'=>$numberorder,
            'numberuser'=>$numberuser,
            'numbercategories'=>$numbercategories,
            'todaysale'=>$todaysale,
            'todaysp'=>$todaysp,
            'mounthsale'=>$mounthsale,
            'mounthsp'=>$mounthsp,
            'listsp'=>$listsp,
            'listganhet'=>$listganhet,
        ]);
    }
}
