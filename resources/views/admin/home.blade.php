@extends('layouts.admin')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-primary o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-comments"></i>
                </div>
                <div class="mr-5">{{$numberproduct}} Product</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-warning o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-list"></i>
                </div>
                <div class="mr-5">{{$numbercategories}} Categories!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-success o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-shopping-cart"></i>
                </div>
                <div class="mr-5">{{$numberorder}} Orders!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="card text-white bg-danger o-hidden h-100">
            <div class="card-body">
                <div class="card-body-icon">
                    <i class="fas fa-fw fa-life-ring"></i>
                </div>
                <div class="mr-5">{{$numberuser}} Customer!</div>
            </div>
            <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-4 col-sm-6 mb-4">
        <div class="card o-hidden h-75">
            <div class="card-body">
                <h6>TODAY'S SALES</h6>
                <div class="mr-5 row">
                    <i class="far fa-chart-bar fa-4x col-4 text-primary"></i>
                    <span style="font-weight: bolder;font-size: 25px;   line-height: 62px; padding-left: 3.5px;">{{number_format($todaysale)}} VNĐ</span>
                </div>
            </div>
            {{-- <a class="card-footer clearfix small z-1" href="#">
                <span class="float-left text-danger">{{$todaysp}}</span> sản phẩm
                <span class="float-right">
                    sản phẩm
                </span>
            </a> --}}
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-4">
        <div class="card o-hidden h-75">
            <div class="card-body">
                <h6>THIS WEEK'S SALES</h6>
                <div class="mr-5 row">
                    <i class="far fa-chart-bar fa-4x col-4 text-warning"></i>
                    <span style="font-weight: bolder;font-size: 25px;   line-height: 62px; padding-left: 3.5px;">{{number_format($todaysale)}} VNĐ</span>
                </div>
            </div>
            {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a> --}}
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-4">
        <div class="card o-hidden h-75">
            <div class="card-body">
                <h6>THIS MOUNTH'S SALES</h6>
                <div class="mr-5 row">
                    <i class="far fa-chart-bar fa-4x col-4 text-success"></i>
                    <span style="font-weight: bolder;font-size: 25px;   line-height: 62px; padding-left: 3.5px;">{{number_format($mounthsale)}} VNĐ</span>
                </div>
            </div>
            {{-- <a class="card-footer text-white clearfix small z-1" href="#">
                <span class="float-left">View Details</span>
                <span class="float-right">
                    <i class="fas fa-angle-right"></i>
                </span>
            </a> --}}
        </div>
    </div>
</div>
<div class="row">
<div class="card mb-3 col-6">
    <div class="card-header">
        <i class="fas fa-table"></i>
        CÁC SẢN PHẨM ĐÃ BÁN
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th></th>
                        <th>Name</th>
                        <th>Quanlity</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($listsp as $sp)
                        <tr>
                            <td>{{$i}}</td>
                            <td><img src="{{$sp['images']}}" alt="" style="width: 50px; height: 50px;"></td>
                            <td>{{$sp['name']}}</td>
                            <td>{{$sp['quanlity']}}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated {{date('d-m-Y')}}</div>
</div>
<div class="card mb-3 col-6">
    <div class="card-header">
        <i class="fas fa-table"></i>
        CÁC SẢN PHẨM SẮP HẾT
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th></th>
                        <th>Name</th>
                        <th>Quanlity</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=0;
                    @endphp
                    @foreach ($listganhet as $sp)
                        <tr>
                            <td>{{$i}}</td>
                            <td><img src="{{$sp->images->first()->link}}" alt="" style="width: 50px; height: 50px;"></td>
                            <td>{{$sp->name}}</td>
                            <td>{{$sp->quanlity}}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer small text-muted">Updated {{date('d-m-Y')}}</div>
</div>
</div>
@endsection
