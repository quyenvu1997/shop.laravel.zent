@extends('master')
@section('content')
<div class="container">
	<table class="table table-hover">
		<thead>
			<tr>
				<th>STT</th>
				<th>Mã hóa đơn</th>
				<th>tổng tiền</th>
				<th>Trạng thái</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@php
				$i=1;
			@endphp
			@foreach ($orders as $order)
				<tr id="order-{{$order->id}}">
					<td>{{$i}}</td>
					<td>{{$order->code}}</td>
					<td>
						@php
						$tong=0;
						foreach ($order->products as $product) {
							$tong+=$product->pivot->quanlity*$product->pivot->price;
						}
						echo number_format($tong).' VNĐ';
						@endphp
					</td>
					<td>{{$order->status->name}}</td>
					<td>
						<button type="" class="main-btn fa fa-eye show" data-toggle="modal" href="#modal-show" data-id="{{$order->id}}"></button> 
						@if ($order->status->id==5)
						<button class="main-btn icon-btn xoa" data_id="{{$order->id}}"><i class="fa fa-close"></i></button>
						@endif	
					</td>
				</tr>
				@php
				$i++;
				@endphp
			@endforeach
		</tbody>
	</table>
</div>
<div class="modal fade" id="modal-show">
	<div class="modal-dialog" style="width: 90%;max-width: 1000px;margin: 1.75rem auto;">
		<div class="modal-content align-middle">
			<div class="modal-header">
				<h3 class="modal-title">Detail order</h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body" >	
				<div id="detail">
					<table >
						<tbody>
							<tr>
								<td style="padding: 5px;"><h5>Mã hóa đơn</h5></td>
								<td class="code" style="padding: 5px 5px 11px 5px;"></td>
							</tr>
							<tr>
								<td style="padding: 5px;"><h5>Tên khách hàng</h5></td>
								<td class="name" style="padding: 5px 5px 11px 5px;"></td>
							</tr>
							<tr>
								<td style="padding: 5px;"><h5>Email</h5></td>
								<td class="email" style="padding: 5px 5px 11px 5px;"></td>
							</tr>
							<tr>
								<td style="padding: 5px;"><h5>Mobile</h5></td>
								<td class="mobile" style="padding: 5px 5px 11px 5px;"></td>
							</tr>
							<tr>
								<td style="padding: 5px;"><h5>Địa chỉ</h5></td>
								<td class="address" style="padding: 5px 5px 11px 5px;"></td>
							</tr>
							<tr>
								<td style="padding: 5px;"><h5>Trạng Thái</h5></td>
								<td class="status" style="padding: 5px 5px 11px 5px;"></td>
							</tr>
						</tbody>
					</table>
					<table class="table">
						<thead>
							<tr>
								<th>Tên SP</th>
								<th>Số Lượng</th>
								<th>Đơn giá</th>
								<th>Thành tiền</th>
							</tr>
						</thead>
						<tbody id="listsp">
						</tbody>
					</table>
				</div>
			</div>	
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$('table').on('click','.show',function(){
		var btn = $(this);
		var id=btn.data('id');
		$.ajax({
			type:'get',
			url:'/orders/'+id,
			success: function(response){
				$('#listsp').children().remove()
				$('.code').text(response.order.code)
				$('.name').text(response.order.name)
				$('.email').text(response.order.email)
				$('.mobile').text(response.order.mobile)
				$('.address').text(response.order.address)
				$('.status').text(response.status)
				// $('.name').text(response.order.name)
				// $('img').attr('src',response.image)
				// $('p').text(response.product.description)
				$tongtien=0
				for (var i = 0; i < response.listsp.length; i++) {
					$('#listsp').append(`<tr>
						<td>`+response.listsp[i].name+`</td>
						<td>`+response.listsp[i].pivot.quanlity+`</td>
						<td>`+(response.listsp[i].pivot.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
						<td>`+(response.listsp[i].pivot.quanlity*response.listsp[i].pivot.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
						</tr>`)
					$tongtien+=response.listsp[i].pivot.quanlity*response.listsp[i].pivot.price
				}
				$('#listsp').append(`<tr>
					<td colspan="3"><h4>Tổng tiền</h4></td>
					<td>`+$tongtien.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
					</tr>`)
			}
		})
	});
	$('.xoa').click(function(){
        var btn = $(this);
        var id=btn.attr('data_id');
        swal({
            title: "Bạn muốn xóa đơn hàng này?",
	        // text: "Once deleted, you will not be able to recover this imaginary file!",
	        icon: "warning",
	        buttons: true,
	        dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type:'get',
                    url:'/orders/delete/'+id,
                    success: function(response){
	                    toastr.success(response.message)
	                    btn.parents('tr').remove();
                	}
            	});
        	} 
   		});    
	});
</script>
@endsection