@extends('master')
@section('content')
{{-- expr --}}
<div class="container">
	<div class="row">
		<!--  Product Details -->
		<div class="product product-details clearfix">
			<div class="col-md-6">
				<div id="product-main-view">
					@foreach ($product->images as $image)
						<div class="product-view">
						<img src="{{$image->link}}" alt="" height="450px" width="100%">
					</div>
					@endforeach
				</div>
				<div id="product-view">
					@foreach ($product->images as $image)
						<div class="product-view">
						<img src="{{$image->link}}" alt="" height="150px">
					</div>
					@endforeach
				</div>
			</div>
			<div class="col-md-6">
				<div class="product-body">
					<div class="product-label">
						<span>New</span>
					</div>
					<h2 class="product-name">{{$product->name}}</h2>
					<h3 class="product-price">{{number_format($product->price_sales)}} <del class="product-old-price">{{number_format($product->price)}}</h3>
					<div>
						<div class="product-rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star-o empty"></i>
						</div>
					</div>
					<p><strong>Availability:</strong> In Stock</p>
					<p><strong>Brand:</strong> E-SHOP</p>
					<p>{{$product->description}}</p>
					<div class="product-btns">
						<div class="qty-input">
							<span class="text-uppercase">QTY: </span>
							<input class="input" type="number">
						</div>
						<a href="{{ asset('cart/add/') }}/{{$product->id}}" class="primary-btn add-to-cart" ><i class="fa fa-shopping-cart"></i> Add to Cart</a>
						{{-- <button class="primary-btn add-to-cart"><i class="fa fa-shopping-cart"></i> Add to Cart</button> --}}
						{{-- <div class="pull-right">
							<button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
							<button class="main-btn icon-btn"><i class="fa fa-exchange"></i></button>
							<button class="main-btn icon-btn"><i class="fa fa-share-alt"></i></button>
						</div> --}}
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="product-tab">
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab2">Details</a></li>
						{{-- <li><a data-toggle="tab" href="#tab2">Reviews (3)</a></li> --}}
					</ul>
					<div class="tab-content">
						<div id="tab1" class="tab-pane fade in active">
							<p>{{$product->description}}</p>
						</div>
						{{-- <div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-6">
									<div class="product-reviews">
										<div class="single-review">
											<div class="review-heading">
												<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
												<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
												<div class="review-rating pull-right">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
											</div>
											<div class="review-body">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
												irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
											</div>
										</div>

										<div class="single-review">
											<div class="review-heading">
												<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
												<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
												<div class="review-rating pull-right">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
											</div>
											<div class="review-body">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
												irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
											</div>
										</div>

										<div class="single-review">
											<div class="review-heading">
												<div><a href="#"><i class="fa fa-user-o"></i> John</a></div>
												<div><a href="#"><i class="fa fa-clock-o"></i> 27 DEC 2017 / 8:0 PM</a></div>
												<div class="review-rating pull-right">
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star"></i>
													<i class="fa fa-star-o empty"></i>
												</div>
											</div>
											<div class="review-body">
												<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute
												irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
											</div>
										</div>

										<ul class="reviews-pages">
											<li class="active">1</li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#"><i class="fa fa-caret-right"></i></a></li>
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<h4 class="text-uppercase">Write Your Review</h4>
									<p>Your email address will not be published.</p>
									<form class="review-form">
										<div class="form-group">
											<input class="input" type="text" placeholder="Your Name" />
										</div>
										<div class="form-group">
											<input class="input" type="email" placeholder="Email Address" />
										</div>
										<div class="form-group">
											<textarea class="input" placeholder="Your review"></textarea>
										</div>
										<div class="form-group">
											<div class="input-rating">
												<strong class="text-uppercase">Your Rating: </strong>
												<div class="stars">
													<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
													<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
													<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
													<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
													<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
												</div>
											</div>
										</div>
										<button class="primary-btn">Submit</button>
									</form>
								</div>
							</div>
						</div> --}}
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-6">
									<img src="{{$product->images->first()['link']}}" alt="" width="80%" height="300px">
								</div>
								<div class="col-md-6">
									<h2>THÔNG SỐ KĨ THUẬT</h2>
									<table class="table table-hover">
										
										<tbody>
											@foreach ($product->attributes as $attribute)
												<tr>
													<td>{{$attribute->name}}</td>
													<td>{{$attribute->pivot->value}}</td>
												</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
								{{-- <div class="col-md-6">
									<h4 class="text-uppercase">Write Your Review</h4>
									<p>Your email address will not be published.</p>
									<form class="review-form">
										<div class="form-group">
											<input class="input" type="text" placeholder="Your Name" />
										</div>
										<div class="form-group">
											<input class="input" type="email" placeholder="Email Address" />
										</div>
										<div class="form-group">
											<textarea class="input" placeholder="Your review"></textarea>
										</div>
										<div class="form-group">
											<div class="input-rating">
												<strong class="text-uppercase">Your Rating: </strong>
												<div class="stars">
													<input type="radio" id="star5" name="rating" value="5" /><label for="star5"></label>
													<input type="radio" id="star4" name="rating" value="4" /><label for="star4"></label>
													<input type="radio" id="star3" name="rating" value="3" /><label for="star3"></label>
													<input type="radio" id="star2" name="rating" value="2" /><label for="star2"></label>
													<input type="radio" id="star1" name="rating" value="1" /><label for="star1"></label>
												</div>
											</div>
										</div>
										<button class="primary-btn">Submit</button>
									</form>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- /Product Details -->
	</div>
</div>
@endsection