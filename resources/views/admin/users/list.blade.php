@extends('layouts.admin')
@section('content')
	{{-- expr --}}
	<table class="table table-hover" id="user">
		<thead>
			<tr>
				<th>Id</th>
				<th>Name</th>
				<th>Email</th>
				<th>Mobile</th>
				<th>Address</th>
				<th>Action</th>
			</tr>
		</thead>
	</table>
	<div class="modal fade" id="modal-edit">
		<div class="modal-dialog" style="width: 90%;max-width: 1000px;margin: 1.75rem auto;">
			<div class="modal-content align-middle">
				<div class="modal-header">
					<h3 class="modal-title">Edit user</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" >	
					<div id="detail">
						<form method="post" id="edit-user" role="form">
							<input type="hidden" id="user-id">
							<div class="form-group">
								<label for="">Name</label>
								<input type="text" class="form-control" id="name-edit">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="email" class="form-control" id="email-edit">
							</div>
							<div class="form-group">
								<label for="">Mobile</label>
								<input type="number" class="form-control" id="mobile-edit">
							</div>
							<div class="form-group">
								<label for="">Address</label>
								<input type="text" class="form-control" id="address-edit">
							</div>	
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-show">
		<div class="modal-dialog" style="width: 90%;max-width: 1000px;margin: 1.75rem auto;">
			<div class="modal-content align-middle">
				<div class="modal-header">
					<h3 class="modal-title">Detail User</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" >	
					<div id="detail">
						<table >
							<tbody>
								<tr>
									<td style="padding: 5px;"><h5>Tên khách hàng</h5></td>
									<td class="name" style="padding: 5px 5px 11px 5px;"></td>
								</tr>
								<tr>
									<td style="padding: 5px;"><h5>Email</h5></td>
									<td class="email" style="padding: 5px 5px 11px 5px;"></td>
								</tr>
								<tr>
									<td style="padding: 5px;"><h5>Số điện thoại</h5></td>
									<td class="mobile" style="padding: 5px 5px 11px 5px;"></td>
								</tr>
								<tr>
									<td style="padding: 5px;"><h5>Địa chỉ</h5></td>
									<td class="address" style="padding: 5px 5px 11px 5px;"></td>
								</tr>
							</tbody>
						</table>
						<table class="table">
							<thead>
								<tr>
									<th>Mã hóa đơn</th>
									<th>tổng tiền</th>
									<th>Trạng thái</th>
									<th>Created_at</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="listorder">
							</tbody>
						</table>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-showorder">
		<div class="modal-dialog" style="width: 90%;max-width: 1000px;margin: 1.75rem auto;">
			<div class="modal-content align-middle">
				<div class="modal-header">
					<h3 class="modal-title">Detail order</h3>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body" >	
					<div>
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
<script type="text/javascript">
	$(function() {
		$('#user').DataTable({
			processing: true,
			serverSide: true,
			ajax: '/admin/listuser',
			columns: [
				{ data: 'id', name: 'Id' },
				{ data: 'name', name: 'Name'},
				{ data: 'email', name:'Email'},
				{ data: 'mobile', name: 'Mobile'},
				{ data: 'address', name: 'Address' },
				{ data: 'Action', name: 'Action'}
			]
		});
	});
	$('table').on('click','.show',function(){
		var btn = $(this);
		var id=btn.data('id');
		$.ajax({
			type:'get',
			url:'/admin/users/'+id,
			success: function(response){
				$('#listorder').children().remove()
				$('.name').text(response.user.name)
				$('.email').text(response.user.email)
				$('.mobile').text(response.user.mobile)
				$('.address').text(response.user.address)
				for(var i = 0; i < response.orders.length; i++){
					$('#listorder').append(`<tr>
											<td>`+response.orders[i].code+`</td>
											<td>`+(response.orders[i].tong_tien).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+` VNĐ</td>
											<td>`+response.orders[i].status_id+`</td>
											<td>`+response.orders[i].created_at+`</td>
											<td><button type="" class="btn btn-info fa fa-eye showorder" data-toggle="modal" href="#modal-showorder" data-id="`+response.orders[i].id+`"></button></td>
										</tr>`)
				}
			}
		})
	});
	$('table').on('click','.showorder',function(){
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
	$('table').on('click','.btn-warning',function(){
		var btn = $(this);
		var id=btn.data('id');
		$.ajax({
			type:'get',
			url:'/admin/users/'+id+'/edit',
			success: function(response){
				$('#name-edit').val(response.user.name)
				$('#email-edit').val(response.user.email)
				$('#mobile-edit').val(response.user.mobile)
				$('#address-edit').val(response.user.address)
				 $('#user-id').val(id)
			}
		})
	})
	$('#edit-user').submit(function(e){
		e.preventDefault()
		var id=$('#user-id').val();
		// var name=$('#name-edit').val();
		// var slug=name.replace(/ /g, '-');
		// var description=$('#description-edit').val();
		var formData= new FormData();
		formData.append('name',$('#name-edit').val());
		formData.append('email',$('#email-edit').val());
		formData.append('mobile',$('#mobile-edit').val());
		formData.append('address',$('#address-edit').val());

		// var formData = $('#edit-category').serialize();
		$.ajax({
			type: 'post',
			url:'/admin/users/update/'+id,
			data:formData,processData: false, contentType: false,
			// dataType: 'json',
			success:function(response){
				$('#modal-edit').modal('hide');
					// toastr.success('Success')
				toastr.success('Edit Successfull!')
				var temp=`<tr>
				<td>`+response.id+`</td>
				<td>`+response.name+`</td>
				<td>`+response.email+`</td>
				<td>`+response.mobile+`</td>
				<td>`+response.address+`</td>
				<td>
				<button type="" class="btn btn-sm btn-info fa fa-eye" data-toggle="modal" href="#modal-show" data-id="`+response.id+`" id="`+response.id+`"></button>
				<button type="" class="btn btn-sm btn-warning btn-edit fa fa-edit text-white" data-toggle="modal" href="#modal-edit" data-id="`+response.id+`"></button>
				<button data-id="`+response.id+`" class="btn btn-danger fa fa-trash-alt"></button>
				</td>
				</tr>`
				$('#'+id).parents('tr').replaceWith(temp)
			}
		})
	})
	</script>
@endsection