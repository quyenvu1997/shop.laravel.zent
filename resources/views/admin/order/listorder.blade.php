@extends('layouts.admin')
@section('content')
{{-- expr --}}
<table class="table table-hover" id="Order">
	<thead>
		<tr>
			<th>id</th>
			<th>code</th>
			<th>name</th>
			{{-- <th>email</th> --}}
			<th>mobile</th>
			<th>address</th>
			<th>status</th>
			<th>action</th>
		</tr>
	</thead>
</table>
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
		{{-- <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div> --}}
	</div>
</div>
<div class="modal fade" id="modal-edit">
	<div class="modal-dialog" style="width: 90%;max-width: 1000px;margin: 1.75rem auto;">
		<div class="modal-content align-middle">
			<div class="modal-header">
				<h3 class="modal-title">Edit order</h3>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<form method="post" id="edit-order" role="form">
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
								<td class="status_edit" style="padding: 5px 5px 11px 5px;">
									
										<input type="hidden" id="order-id">
										<select name="status" id="status">
											@foreach ($statuses as $status)
												<option value="{{$status->id}}" id="status-{{$status->id}}">{{$status->name}}</option>
											@endforeach
										</select>
								</td>
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
						<tbody id="listsp_edit">
						</tbody>
					</table>
				</div>
			</div>	
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="submit" class="btn btn-primary">Save</button>
		</div>
	</form>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$('#Order').DataTable({
			processing: true,
			serverSide: true,
			ajax: '/admin/listorder',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'code', name: 'code'},
			{ data: 'name', name: 'name'},
			// { data: 'email', name:'email'},
			{ data: 'mobile', name: 'mobile'},
			{ data: 'address', name: 'address' },
			{ data: 'status', name: 'status' },
			{ data: 'action', name: 'action'}
			]
		});
	});
	$('table').on('click','.btn-info',function(){
		var btn = $(this);
		var id=btn.data('id');
		$.ajax({
			type:'get',
			url:'/admin/orders/'+id,
			success: function(response){
				$('#listsp').children().remove()
				$('.code').text(response.order.code)
				$('.name').text(response.order.name)
				$('.email').text(response.order.email)
				$('.mobile').text(response.order.mobile)
				$('.address').text(response.order.address)
				$('.status').text(response.status)
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
	$('table').on('click','.btn-warning',function(){
		var btn = $(this);
		var id=btn.data('id');
		$.ajax({
			type:'get',
			url: '/admin/orders/edit/'+id,
			success:function(response){
				$('#listsp_edit').children().remove()
				$('.code').text(response.order.code)
				$('.name').text(response.order.name)
				$('.email').text(response.order.email)
				$('.mobile').text(response.order.mobile)
				$('.address').text(response.order.address)
				$('#order-id').val(response.order.id)
				$('#status-'+response.status).attr('selected','selected')
				$tongtien=0
				for (var i = 0; i < response.listsp.length; i++) {
					$('#listsp_edit').append(`<tr>
											<td>`+response.listsp[i].name+`</td>
											<td>`+response.listsp[i].pivot.quanlity+`</td>
											<td>`+(response.listsp[i].pivot.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
											<td>`+(response.listsp[i].pivot.quanlity*response.listsp[i].pivot.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
										</tr>`)
					$tongtien+=response.listsp[i].pivot.quanlity*response.listsp[i].pivot.price
				}
				$('#listsp_edit').append(`<tr>
											<td colspan="3"><h4>Tổng tiền</h4></td>
											<td>`+$tongtien.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
										</tr>`)
			}
		});
	})
	$('#edit-order').submit(function(e){
		e.preventDefault()
		var id=$('#order-id').val();
		// var status=$("#status").find(":selected").val();
		// console.log(status);
		$.ajax({
			type: 'post',
			url:'/admin/orders/update/'+id,
			data:{
				status:$("#status").find(":selected").val(),
			},
			success:function(response){
				$('#modal-edit').modal('hide');
				toastr.success('Edit Successfull!')
				$('#'+response.order.id).parent().prev().text(response.status)
				if (response.order.status_id==3) {
					$('#'+response.order.id).nextAll().remove()
				}
			}
		})
	})
	$('.table').on('click','.btn-danger',function(){
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