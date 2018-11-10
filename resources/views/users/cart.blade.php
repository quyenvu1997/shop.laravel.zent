@extends('master')
@section('content')
{{-- expr --}}
{{-- <div class="container">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Tên sản phẩm</th>
				<th>Giá tiền</th>
				<th>Số lượng</th>
				<th>Thành tiền</th>
			</tr>
		</thead>
		<tbody>
			@foreach (Cart::content() as $row)
				<tr>
					<td>
						<p><strong>{{$row->name}}</strong></p>
	                </td>
	                <td>{{number_format($row->price)}}</td>
	                <td>
	                    <button class="btn btn-primary" status="+1" rowid="{{$row->rowId}}">ADD</button>
	                    <input type="text" value="{{$row->qty}}" id="qty-{{$row->rowId}}" size="1">
	                    <button class="btn btn-primary" status="-1" rowid="{{$row->rowId}}">MINUS</button>
	                </td>
	                <td id="total-{{$row->rowId}}">{{number_format($row->subtotal)}}</td>
	            </tr>
            @endforeach
                <tr>
                    <td colspan="3"><b>Tổng tiền</b></td>
                    <td>{{Cart::subtotal()}}</td>
                </tr>
        </tbody>
    </table>
</div> --}}

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
                        <button class="main-btn change" status="+1" rowid="{{$row->rowId}}">ADD</button>
                        <input class="input" type="number" value="{{$row->qty}}" id="qty-{{$row->rowId}}">
                        <button class="main-btn change" status="-1" rowid="{{$row->rowId}}">MINUS</button>
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
            <button class="primary-btn">Place Order</button>
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
        	var rowId=$(this).attr('rowid')
        	var status=$(this).attr('status')
        	$.ajax({
        		type:'get',
        		url:'/cart/update?rowid='+rowId+'&status='+status,
        		success:function(response){
        			$('#qty-'+rowId).val(response.rowId.qty);
        			$('#total-'+rowId).text(response.rowId.qty*response.rowId.price);
                    $('.sub-total').text(response.subtotal);
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
                        btn.parents('tr').remove()
                        $('.sub-total').text(response);
                    }
                });
            } 
            // else {
            //  swal("Your imaginary file is safe!");
            // }
        });
        
    });
    })
</script>
@endsection