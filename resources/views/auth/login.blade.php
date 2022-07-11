{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
<!doctype html>
<html lang="en">
  <head>
  	<title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="{{ asset('log/css/style.css') }}">

	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h3 class="heading-section">{{ __('Login') }}</h3>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user-o"></span>
		      	</div>
		      	<h3 class="text-center mb-4">{{ __('Have an account?') }}</h3>
                        <x-auth-session-status class="mb-4" :status="session('status')" />

         <x-auth-validation-errors class="mb-4" :errors="$errors" />
						<form action="{{ route('login') }}" method="POST" class="login-form">
                            @csrf
		      		<div class="form-group">
		      			<input type="email" class="form-control rounded-left" placeholder="email" name="email" >
		      		</div>
	            <div class="form-group d-flex">
	              <input type="password" class="form-control rounded-left" placeholder="Password" name="password">
	            </div>
	            <div class="form-group d-md-flex">
	            	<div class="w-50">
	            		<label class="checkbox-wrap checkbox-primary">{{ __('Remember Me') }}
									  <input type="checkbox" name="remember">
									  <span class="checkmark"></span>
									</label>
								</div>
								{{-- <div class="w-50 text-md-right">
									<a href="#">Forgot Password</a>
								</div> --}}
                                           @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-primary rounded submit p-3 px-5">{{ __('Log In') }}</button>
	            </div>
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>

	<script src="{{ asset('log/js/jquery.min.js') }}"></script>
  <script src="{{ asset('log/js/popper.js') }}"></script>
  <script src="{{ asset('log/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('log/js/main.js') }}"></script>

	</body>
</html>

