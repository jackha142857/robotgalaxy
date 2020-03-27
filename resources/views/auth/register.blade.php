@extends('layouts.home')

@section('content')

<div class="containerLogin">
	<div class="d-flex justify-content-center h-100">
		<div class="card cardLogin">
			<div class="card-header">
				<h3>Sign Up</h3>
				<div class="d-flex justify-content-end social_icon">
					<span><i class="fab fa-facebook-square"></i></span>
					<span><i class="fab fa-google-plus-square"></i></span>
					<span><i class="fab fa-twitter-square"></i></span>
				</div>
			</div>
			<div class="card-body">
				<form method="POST" action="{{ route('register') }}">
				@csrf
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" 
						value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="name">					
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
						name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email">
						@error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
						name="password" required autocomplete="current-password" placeholder="password">
						@error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password-confirm" type="password" class="form-control"
						 name="password_confirmation" required autocomplete="new-password" placeholder="confirm password">
					</div>
					<div class="form-group">
						<input type="submit" value="Register" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Have an account?<a href="{{ route('login') }}">Login</a>
				</div>
				 @if (Route::has('password.request'))
				<div class="d-flex justify-content-center">
					<a href="{{ route('password.request') }}">Forgot your password?</a>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection
