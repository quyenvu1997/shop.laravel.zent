<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Yajra\Datatables\Datatables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.list');
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
        return response()->json([
            'user'=>User::find($id),
            'orders'=>User::find($id)->orders,
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
            'user'=>User::find($id),
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
        $data = $request->all();
        $user=User::updateData($id,$data);
        return $user;
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
    public function getdata()
    {
        // dd(User::query());
        return Datatables::of(User::query())
            ->addColumn('Action', function ($user) {
                return '<button type="" class="btn btn-sm btn-info fa fa-eye show" data-toggle="modal" href="#modal-show" data-id="'.$user->id.'" id="'.$user->id.'"></button>
                <button type="" class="btn btn-sm btn-warning fa fa-edit text-white" data-toggle="modal" href="#modal-edit" data-id="'.$user->id.'"></button> 
                <button data-id="'.$user->id.'" class="btn btn-danger fa fa-trash-alt"></button>';
            })
            // // ->editColumn('thumbnail', function ($user) {
            // //     return '<img src="'.$user->thumbnail.'" alt="">';
            // // })
            ->rawColumns(['Action'])
            ->make(true);
    }
}
