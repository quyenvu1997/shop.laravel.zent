<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function search(Request $request){
        $category= $request->categories;
        dd($request->all());
        $posts=Post::Where('title','like','%'.$q.'%')
            ->orwhere('description','like','%'.$q.'%')
            ->orwhere('content','like','%'.$q.'%')
            ->paginate(5);
        return view('user.searchs',['posts'=>$posts, 'q' => $q]);
    }
}
