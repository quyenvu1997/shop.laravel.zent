@extends('master')
@section('content')
{{-- expr --}}
<div class="container">
	{{-- @if (isset($message))
	<script type="text/javascript">
		toastr.success($message);
	</script>
		
	@endif --}}
	<div class="row">
		@foreach ($products as $product)

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
				<div class="product-body" >
					<h3 class="product-price">{{number_format($product->price_sales)}} <del class="product-old-price">{{number_format($product->price)}}</del></h3>
					<div class="product-rating">
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star"></i>
						<i class="fa fa-star-o empty"></i>
					</div>
					<h2 class="product-name" style="height: 50px !important;"><a href="{{ asset('products/') }}/{{$product->slug}}" >{{$product->name}}</a></h2>
					<div class="product-btns">
						<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
						<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
						<button class="primary-btn add-to-cart" data-id='{{$product->id}}'><i class="fa fa-shopping-cart"></i> Add to Cart</button>
						{{-- <a href="{{ asset('cart/add/') }}/{{$product->id}}" title="" class="primary-btn add-to-cart" data-id='{{$product->id}}'><i class="fa fa-shopping-cart"></i> Add to Cart</a> --}}
					</div>
				</div>
			</div>
		</div>
		@endforeach
	</div>
	<div class="navigation">
		@if ($products->currentPage()!=1)
		<a href="{{$products->previousPageUrl()}}" class="prev primary-btn float-left"><i class="icon-arrow-left8"></i> Previous Posts</a>
		@endif

		@if ($products->hasMorePages())
		<a href="{{$products->nextPageUrl()}}" class="next primary-btn float-right">Next Posts <i class="icon-arrow-right8"></i></a>
		@endif
		{{-- <a href="{{$posts->nextPageUrl()}}" class="next">Next Posts <i class="icon-arrow-right8"></i></a> --}}
		<div class="clearfix"></div>
	</div>
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
        			if (response.message!=null) {
        				toastr.error(response.message);
        			}else{
        				$('#qty-cart').text(response.qty_cart);
                    	$('#total-cart').text(response.subtotal);
        			}
                    
        		}
        	})
        })       
    });
</script>
@endsection