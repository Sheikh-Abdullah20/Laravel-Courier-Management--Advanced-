<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/imgs/guest-imgs/logo.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/css/main.css?v=6.0') }}" rel="stylesheet" type="text/css" />
    @yield('css')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('guest') }}"><x-application-logo/></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-2 ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="btn btn-success" aria-current="page" href="{{ route('login') }}">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      {{-- {{ content }} --}}
      @yield('content')
      {{-- {{ content }} --}}
</body>
<script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/alert.js') }}"></script>
</html>