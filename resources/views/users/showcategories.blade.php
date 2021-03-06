@extends('master')
@section('content')
{{-- {{dd($category->products)}} --}}

<div class="container">
	

	@foreach ($category->products as $product)

	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="product product-single">
			<div class="product-thumb">
				<div class="product-label">
					<span>New</span>
				</div>
				<a href="{{ asset('products/') }}/{{$product->slug}}" title=""class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</a>
				{{-- <button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button> --}}
				<img src="{{$product->images->first()['link']}}" alt="" height="250px">
			</div>
			<div class="product-body">
				<h3 class="product-price">{{number_format($product->price_sales)}} <del class="product-old-price">{{number_format($product->price)}}</del></h3>
				<div class="product-rating">
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star"></i>
					<i class="fa fa-star-o empty"></i>
				</div>
				<h2 class="product-name"><a href="#">{{$product->name}}</a></h2>
				<div class="product-btns">
					<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
					<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
					{{-- <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button> --}}
					<button class="primary-btn add-to-cart" data-id='{{$product->id}}'><i class="fa fa-shopping-cart"></i> Add to Cart</button>
				</div>
			</div>
		</div>
	</div>
	@endforeach

</div>
<script type="text/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$(function(){
		$('.add-to-cart').click(function(){
			var id=$(this).attr('data-id')
			$.ajax({
				type:'get',
				url:'/cart/add/'+id,
				success:function(response){
					$('#qty-cart').text(response.qty_cart);
					$('#total-cart').text(response.subtotal);
				}
			})
		})       
	});
</script>
@endsection