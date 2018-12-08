@extends('master')
@section('content')
<div class="container">
    <div class="order-summary clearfix">
        <div class="section-title">
            <h3 class="title">Order Review</h3>
        </div>
        <table class="shopping-cart-table table">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th></th>
                    <th class="text-center">Đơn giá</th>
                    <th class="text-center">Số lượng</th>
                    <th class="text-center">Thành tiền</th>
                    <th class="text-right"></th>
                </tr>
            </thead>
            <tbody>
                @foreach (Cart::content() as $row)
                <tr>
                    <td class="thumb"><img src="{{App\Product::find($row->id)->images->first()['link']}}" alt=""></td>
                    <td class="details">
                        <a href="#">{{$row->name}}</a>
                    </td>
                    <td class="price text-center"><strong>{{number_format($row->price)}}</strong><br><del class="font-weak"><small>{{number_format(App\Product::find($row->id)->price)}}</small></del></td>
                    <td class="qty text-center">
                        <button class="main-btn change" status="+1" rowid="{{$row->rowId}}"><i class="fa fa-plus"></i></button>
                        <button class="btn btn-link" id="qty-{{$row->rowId}}">{{number_format($row->qty)}}</button>

                        {{-- <span class="border" style="width: 50px !important;">{{number_format($row->qty)}}</span> --}}
                        {{-- <input class="input" type="number" value="{{$row->qty}}" id="qty-{{$row->rowId}}"> --}}
                        <button class="main-btn change" status="-1" rowid="{{$row->rowId}}"><i class="fa fa-minus"></i></button>
                    </td>
                    <td class="total text-center primary-color" id="total-{{$row->rowId}}">{{number_format($row->subtotal)}}</td>
                    <td class="text-right"><button class="main-btn icon-btn xoa" rowid="{{$row->rowId}}"><i class="fa fa-close"></i></button></td>
                </tr>
                @endforeach
                
            </tbody>
            <tfoot>
                <tr>
                    <th class="empty" colspan="3"></th>
                    <th>Tổng tiền</th>
                    <th colspan="2" class="sub-total">{{Cart::subtotal()}}</th>
                </tr>
            </tfoot>
        </table>
        <div class="pull-right">
            <a href="{{ asset('/checkout') }}" title="" class="primary-btn">ĐẶT HÀNG</a>
            {{-- <button class="primary-btn">Place Order</button> --}}
        </div>
    </div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function(){
        $('.change').click(function(){
            var btn = $(this);
            var rowId=$(this).attr('rowid')
            var status=$(this).attr('status')
            $.ajax({
              type:'get',
              url:'/cart/update?rowid='+rowId+'&status='+status,
              success:function(response){
                
                if (response.message!=null) {
                    toastr.error(response.message);
                }else {
                    if (response.delete=='true') {
                        btn.parents('tr').remove();
                        $('.sub-total').text(response.subtotal);
                        $('#qty-cart').text(response.qty_cart);
                        $('#total-cart').text(response.subtotal);
                    }
                    $('#qty-'+rowId).text(response.rowId.qty);
                    $('#total-'+rowId).text((response.rowId.qty*response.rowId.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
                    $('.sub-total').text(response.subtotal);
                    $('#qty-cart').text(response.qty_cart);
                    $('#total-cart').text(response.subtotal);
                    }
                
                }
            })
        })
        $('.xoa').click(function(){
            var btn = $(this);
            var id=btn.attr('rowid');
            swal({
                title: "Bạn muốn xóa sản phẩm này khỏi giỏ hàng không?",
            // text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type:'get',
                        url:'/cart/delete?rowId='+id,
                        success: function(response){
                        //toastr.success(response.message)
                        btn.parents('tr').remove();
                        $('.sub-total').text(response.subtotal);
                        $('#qty-cart').text(response.qty_cart);
                        $('#total-cart').text(response.subtotal);
                    }
                });
                } 
            });    
        });
    })
</script>
@endsection