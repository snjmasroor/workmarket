<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<title>Workmarket</title>
<link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

<!-- Google Material Icons --><link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- CSS Files -->
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

<div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form method="post" action="{{ route('login') }}" class="form-signin">
                        @csrf
						<div class="account-logo">
                            <a href="index-2.html"><img src="{{asset('assets/img/logo-dark.png')}}" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Username or Email</label>
                             <input id="email" type="email" class="form-control is-invalid " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                               
                                   
                               
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control  is-invalid" name="password" required autocomplete="current-password">
                               
                                   
                               
                        </div>
                        <div class="form-group text-right">
                             @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don’t have an account? <a href="register.html">Register Now</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- Plugins -->
<script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('assets/js/Chart.bundle.js') }}"></script>
<script src="{{ asset('assets/js/chart.js') }}"></script>
<!-- Custom App Script -->
<script src="{{ asset('assets/js/app.js') }}"></script>


</body>



</html>
