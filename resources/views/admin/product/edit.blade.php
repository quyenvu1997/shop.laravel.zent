@extends('layouts.admin')
@section('content')
{{-- expr --}}
<form action="{{ asset('/admin/products/update/') }}/{{$product->id}}" method="POST" role="form" enctype="multipart/form-data">
	@csrf
	<div class="row">
		<div class="col-6">
			<div class="form-group">
				<label for=""><h5>Name</h5></label>
				<input type="text" class="form-control" id="" name="name" value="{{$product->name}}">
			</div>
			<div class="form-group">
				<label for=""><h5>Price</h5></label>
				<input type="number" class="form-control" id="" name="price" value="{{$product->price}}">
			</div>
			<div class="form-group">
				<label for=""><h5>Price_sale</h5></label>
				<input type="number" class="form-control" id="" name="price_sales" value="{{$product->price_sales}}">
			</div>
			<div class="form-group">
				<label><h5>Description:</h5></label>
				<textarea name="description" class="form-control" rows="5">{{$product->description}}</textarea>
			</div>
			<div class="form-group">
				<label for=""><h5>Quanlity</h5></label>
				<input type="number" class="form-control" id="" name="quanlity" value="{{$product->quanlity}}">
			</div>
			<div class="form-group">
				<label for=""><h5>Image</h5></label>
				<br>
				<input type="file" name="images[]" value="" placeholder="" multiple="multiple">
			</div>
			<div class="form-group">
				<label for=""><h5>Categories</h5></label>
				<br>
				@foreach ($categories as $category)
					<input type="radio" name="categories" value="{{$category->id}}" placeholder=""
					@if ($category->id==$product->category_id)
						checked
					@endif>{{$category->name}}
					{{-- <input type="checkbox" name="categories" value="{{$category->id}}">{{$category->name}} --}}
					<br>
				@endforeach
			</div>
		</div>
		<div class="col-6">
			@foreach ($attributes as $attribute)
			<div class="form-group">
				<label for=""><h5>{{$attribute->name}}</h5></label>
				<input type="text" class="form-control" id="" name="{{$attribute->id}}"
					@foreach ($product->attributes as $att)
						@if ($att->name==$attribute->name)
							value="{{$att->pivot->value}}"
						@endif
					@endforeach
				>
			</div>
			@endforeach
			</div>
			<br>
		</div>
	</div>
	<button type="submit" class="btn btn-primary" style="margin: 15px;">Submit</button>
</form>
@endsection