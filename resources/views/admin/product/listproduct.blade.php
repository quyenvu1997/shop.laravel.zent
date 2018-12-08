@extends('layouts.admin')
@section('content')
{{-- expr --}}
<a href="{{ asset('admin/products/create') }}" title="" class="btn btn-primary fa fa-plus"></a>
<table class="table table-hover" id="Product">
	<thead>
		<tr>
			<th>id</th>
			<th>name</th>
			<th>price</th>
			<th>image</th>
			<th>quanlity</th>
			<th>action</th>
		</tr>
	</thead>
</table>
<div class="modal fade" id="modal-show">
	<div class="modal-dialog" style="width: 90%;max-width: 1000px;margin: 1.75rem auto;">
		<div class="modal-content align-middle" >
			<div class="modal-header">
				<h4 class="modal-title">Detail product</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">	
				<div class="row">
					<div class="col-6">
						<h3></h3>
						<img src="" alt="" class="w-100 img-details">
					</div>
					<div class="col-6">
						<br>
						<p></p>
						<h4>THÔNG SỐ KỸ THUẬT</h4>
						<table class="table table-hover" id="TSKT">
						</table>
					</div>
				</div>
			</div>	
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
		$('#Product').DataTable({
			processing: true,
			serverSide: true,
			ajax: '/admin/listproduct',
			columns: [
			{ data: 'id', name: 'id' },
			{ data: 'name', name: 'name'},
			{ data: 'price', name:'price'},
			{ data: 'image', name: 'image'},
			{ data: 'quanlity', name: 'quanlity' },
			{ data: 'action', name: 'action'}
			]
		});
	});
	$('table').on('click','.btn-info',function(){
		var btn = $(this);
		var id=btn.data('id');
		$.ajax({
			type:'get',
			url:'/admin/products/'+id,
			success: function(response){
				$('#TSKT').children().remove()
				$('h3').text(response.product.name)
				$('.img-details').attr('src',response.image)
				$('p').text(response.product.description)
				for (var i = 0; i < response.attributes.length; i++) {
					$('#TSKT').append(`<tr>
						<td>`+response.attributes[i].name+`</td>
						<td>`+response.attributes[i].pivot.value+`</td>
						</tr>`)
				}
			}
		})
	});
</script>
@endsection
