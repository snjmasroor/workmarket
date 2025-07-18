<!doctype html>
<html
  lang="en"
  class="light-style layout-wide customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}/"
  data-template="horizontal-menu-template-no-customizer"
  data-style="light">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>GrowNest</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/form-validation.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!-- Config -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

<style>
  body,
  html {
    height: 100%;
    margin: 0;
    
    background-size: cover;
    font-family: 'Segoe UI', sans-serif;
  }

  .login-wrapper {
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(6px);
  }

  .auth-card {
    background: rgba(255, 255, 255, 0.92);
    padding: 3rem;
    border-radius: 1rem;
    box-shadow: 0 0 35px rgba(0, 0, 0, 0.15);
    width: 100%;
    max-width: 420px;
  }

  .auth-logo img {
    height: 55px;
  }

  .auth-card h4 {
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  .form-control:focus {
    box-shadow: none;
    border-color: #3b82f6;
  }

  .social-icons a {
    margin: 0 6px;
  }
  #bg-video {
  top: 0;
  left: 0;
  object-fit: cover;
  z-index: -1;
}
</style>    
</head>
  <body>
<video autoplay muted loop id="bg-video" class="position-fixed w-100 h-100 object-fit-cover z-n1">
  <source src="{{ asset('assets/img/login.mp4') }}" type="video/mp4">
  Your browser does not support the video tag.
</video>
   <div class="login-wrapper">
  <div class="auth-card text-center">
    <!-- Logo -->
    <div class="auth-logo mb-4">
      <a href="{{ url('/') }}">
        <img src="{{ asset('assets/img/logo.webp') }}" alt="Logo">
      </a>
    </div>

    <!-- Title -->
    <h4>Welcome to GrowNest! 👋</h4>
    <p class="mb-4 text-muted">Please sign in to continue</p>

    <!-- Login Form -->
    <form action="{{ route('login') }}" method="POST">
      @csrf

      <div class="mb-3 text-start">
        <label class="form-label">Email or Username</label>
        <input type="text" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="Enter your email or username">
      </div>

      <div class="mb-3 text-start">
        <label class="form-label">Password</label>
        <div class="input-group">
          <input type="password" name="password" class="form-control" placeholder="********" required>
          <span class="input-group-text"><i class="ti ti-eye-off"></i></span>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="remember-me">
          <label class="form-check-label" for="remember-me">Remember Me</label>
        </div>
        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot Password?</a>
        @endif
      </div>

      <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

      <p class="mb-2">New on our platform? <a href="{{ route('user.register.form') }}">Create an account</a></p>

      <div class="divider my-3">
        <span class="text-muted">or sign in with</span>
      </div>

      <div class="social-icons d-flex justify-content-center">
        <a href="#" class="btn btn-sm btn-icon btn-outline-primary rounded-circle">
          <i class="ti ti-brand-facebook-filled"></i>
        </a>
        <a href="#" class="btn btn-sm btn-icon btn-outline-info rounded-circle">
          <i class="ti ti-brand-twitter-filled"></i>
        </a>
        <a href="#" class="btn btn-sm btn-icon btn-outline-dark rounded-circle">
          <i class="ti ti-brand-github-filled"></i>
        </a>
        <a href="#" class="btn btn-sm btn-icon btn-outline-danger rounded-circle">
          <i class="ti ti-brand-google-filled"></i>
        </a>
      </div>
    </form>
  </div>
</div>


       <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/@form-validation/popular.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/auto-focus.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/pages-auth.js') }}"></script>

  </body>
</html>
