@extends('master')
@section('content')
{{-- expr --}}
<div class="container">
	

@foreach ($products as $product)
	<div class="col-md-4 col-sm-6 col-xs-6">
		<div class="product product-single">
			<div class="product-thumb">
				<div class="product-label">
					<span>New</span>
				</div>
				<button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>
				<img src="https://www.thegioididong.com/dtdd/samsung-galaxy-note-9" alt="">
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
					<button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
				</div>
			</div>
		</div>
	</div>
@endforeach

</div>
@endsection