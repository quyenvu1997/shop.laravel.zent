
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
	<div class="login-container">
		<form action="{{ route('register') }}" method="POST" class="form-login">
			@csrf
			<ul class="login-nav" style="margin: 0 0 2em 1em;">
				<li class="login-nav__item active">
					<a href="#">Sign UP</a>
				</li>
				{{-- <li class="login-nav__item">
					<a href="#">Sign Up</a>
				</li> --}}
			</ul>

			<label class="login__label">
				Name
			</label>
			<input class="login__input form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" id="name" name="name" value="{{ old('name') }}" required autofocus/>
			@if ($errors->has('name'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

			<label for="email" class="login__label">
				{{ __('E-Mail Address') }}
			</label>
			<input class="login__input form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" type="text" name="email" value="{{ old('email') }}" required autofocus/>
			@if ($errors->has('email'))
			<span class="invalid-feedback" role="alert">
				<strong>{{ $errors->first('email') }}</strong>
			</span>
			@endif

			<label for="username" class="login__label">{{ __('username') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="login__input form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>

                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
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

			<label for="password-confirm" class="login__label">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="login__input form-control" name="password_confirmation" required>

			<button class="login__submit" type="submit">{{ __('Sign Up') }}</button>
		</form>
		<a href="{{ route('password.request') }}" class="login__forgot"  style="margin-top: 1.5rem;">{{ __('Forgot Your Password?') }}</a>
		<a href="{{ route('login') }}" title="" class="login__forgot" style="margin-top: 1.5rem;"> Have an account? Sign in</a>
		
	</div>
</body>
</html>