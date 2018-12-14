@extends('master')
@section('content')
{{-- expr --}}
<div class="container">
	<div class="row">
		<div class='col-12 col-md-6'> 
			<h1>Billing Address</h1>
			<form action="{{ asset('/orders/create') }}" method="post">
				@csrf
				{{-- <div class="row" style="padding: 10px 0px;">
					<div class="col-md-6 mb-3">
						<label for="first_name">First Name <span>*</span></label>
						<input type="text" class="form-control" id="first_name" value="" name="">
					</div>
					<div class="col-md-6 mb-3">
						<label for="last_name">Last Name <span>*</span></label>
						<input type="text" class="form-control" id="last_name" value="" required>
					</div>
				</div> --}}
				<div class="col-12 mb-3" style="padding: 10px 0px;">
					<label for="name">Name</label>
					@if (Auth::check())
						<input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}" name="name">
						@else
						<input type="text" class="form-control" id="name" value="" name="name">
					@endif
				</div>
				<div class="col-12 mb-3" style="padding: 10px 0px;">
					<label for="phone_number">Mobile <span>*</span></label>
					@if (Auth::check())
						<input type="number" class="form-control" id="mobile" value="{{ Auth::user()->mobile }}" name="mobile">
						@else
						<input type="number" class="form-control" id="mobile" value="" name="mobile">
					@endif
					
				</div>
				<div class="col-12 mb-3" style="padding: 10px 0px;">
					<label for="street_address">Address <span>*</span></label>
					@if (Auth::check())
						<input type="text" class="form-control" id="address" value="{{ Auth::user()->address }}" name="address">
						@else
						<input type="text" class="form-control mb-3" id="address" value="" name="address">
					@endif
					
				</div>
				<div class="col-12 mb-4" style="padding: 10px 0px;">
					<label for="email_address">Email <span>*</span></label>
					@if (Auth::check())
						<input type="email" class="form-control" id="email_address" value="{{ Auth::user()->email }}" name="email">
						@else
						<input type="email" class="form-control" id="email_address" value="" name="email">
					@endif
					
				</div>
				<div class="col-12 mb-4" style="padding: 10px 0px;">
					<label>Notes <span>*</span></label>
					{{-- <input type="text" name="" value="" placeholder=""> --}}
					<textarea class="form-control" name="notes" id="notes"></textarea>
					{{-- <input type="email" class="form-control" id="email_address" value="" name="email"> --}}
				</div>
				<div class="col-12 mb-4" style="padding: 10px 0px;">
					<label>Payment <span>*</span></label>
					<br>
					@foreach ($payments as $payment)
						<input type="radio" name="payment" value="{{$payment->id}}" placeholder=""> {{$payment->name}}
						<br>
					@endforeach
				</div>
				<button type="submit"  class="primary-btn">ĐẶT HÀNG</button>
				{{-- <a href="" title="" class="primary-btn">ĐẶT HÀNG</a> --}}

			</form>
		</div>

		<div class="col-12 col-md-6 col-lg-5 ml-lg-auto">
			<div class="border"  style="font-size: 20px;">
				<div class="cart-page-heading">
					<h1>Your Order</h1>
					<p>The Details</p>
					<table class="table table-hover">
						<thead>
							<tr>
								<th class="bold">Product</th>
								<th class="bold text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							@foreach (Cart::content() as $row)
							<tr>
								<td>
									<a href="#">{{$row->qty}} x {{$row->name}}</a>
								</td>	
								<td class="total text-right primary-color">{{number_format($row->subtotal)}} VNĐ</td>
							</tr>
							@endforeach
							<tr>
								<td style="font-size: 20px;font-weight: bold;">Total</td>
								<td class="total text-right primary-color">{{Cart::subtotal()}} VNĐ</td>
							</tr>
						</tbody>
					</table>
				</div>
				<br>
			</div>
		</div>

	</div>
</div>
@endsection