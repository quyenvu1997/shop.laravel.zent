<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
	<div class="login-container">
		<form method="POST" action="{{ asset('admin/login') }}" class="form-login">
			@csrf
			<ul class="login-nav" style="margin: 0 0 3em 1em;">
				<li class="login-nav__item active">
					<a href="#">Sign In</a>
				</li>
				{{-- <li class="login-nav__item">
					<a href="#">Sign Up</a>
				</li> --}}
			</ul>
			<label for="username" class="login__label">
				{{ __('E-Mail Address') }}
			</label>
			<input class="login__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="text" name="email" value="{{ old('email') }}" required autofocus/>
			@if ($errors->has('email'))
			<span class="invalid-feedback" role="alert">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
			@endif
			<label for="password" class="login__label">
				{{ __('Password') }}
			</label>
			<input class="login__input form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" type="password" name="password" required/>
			@if ($errors->has('password'))
			<span class="invalid-feedback" role="alert">
				<strong>{{ $errors->first('password') }}</strong>
			</span>
			@endif
			<label for="login-sign-up" class="login__label--checkbox">
				<input type="checkbox" class="login__input--checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
				Keep me Signed in
			</label>
			<button class="login__submit" type="submit">{{ __('Login') }}</button>
		</form>
		<a href="{{ route('password.request') }}" class="login__forgot"  style="margin-top: 1.5rem;">{{ __('Forgot Your Password?') }}</a>
		{{-- <a href="{{ route('register') }}" title="" class="login__forgot" style="margin-top: 1.5rem;">Don't have an account? Sign up</a> --}}
		
	</div>
</body>
</html>