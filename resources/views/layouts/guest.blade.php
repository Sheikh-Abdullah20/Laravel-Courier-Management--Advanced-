<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/vendors/bootstrap.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/imgs/guest-imgs/final-logo.png') }}" type="image/x-icon">
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
                <a class="btn btn-success" aria-current="page" href="{{ route('login') }}"><i class="icon material-icons md-person mx-1"></i>Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      {{-- {{ content }} --}}
      <section>
        @yield('content')
      </section>
      {{-- {{ content }} --}}

      <div class="container-fluid">
      <footer>
        <div class="footer-main">
          <div class="row text-center">
            <div class="col-md-4">
             <a href="{{ route('guest') }}"> <x-application-logo/></a>
              <p>The most trusted Courier
                company in your area.</p>
            </div>

            <div class="col-md-4">
              <h3>Contact Us</h3>
              <ul>
                <li class="my-1"><a href="mailto:abdullahsheikhmuhammad21@gmail.com">info@courier.pk</a></li>
                <li class="my-1"><a href="tel:+923092657113">+923092657113</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h3>Social Links</h3>
              <ul class="d-flex justify-content-center ">
                <li class="mx-3"><a href="https://www.instagram.com/sheikh_abdullah2004/?utm_source=qr&igsh=MWR4bWY5NHpmcHY4Mw%3D%3D" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram">
                  <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                  <path d="M16 11.37a4 4 0 1 1-7.94 1.18 4 4 0 0 1 7.94-1.18z"></path>
                  <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                </svg>
                </a></li>
                <li class="mx-3"><a href="https://www.linkedin.com/in/sheikh-muhammad-abdullah-44a203262/" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin">
                  <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2h-1a2 2 0 0 0-2 2v7H9v-7a6 6 0 0 1 6-6z"></path>
                  <rect x="2" y="9" width="4" height="12"></rect>
                  <circle cx="4" cy="4" r="2"></circle>
                </svg>
                </a></li>
                <li class="mx-3"><a href="https://github.com/Sheikh-Abdullah20" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github">
                  <path d="M16 22v-2.87a4 4 0 0 0-1.17-2.83c3.9-.44 8-1.95 8-8.75a6.87 6.87 0 0 0-1.86-4.8 6.44 6.44 0 0 0-.11-4.81S19.73.66 16 2.53a13.38 13.38 0 0 0-8 0C4.27.66 2.03 2.74 2.03 2.74a6.44 6.44 0 0 0-.11 4.81A6.87 6.87 0 0 0 0 12.55c0 6.77 4.1 8.28 8 8.75a4 4 0 0 0-1.17 2.83V22"></path>
                </svg>
                </a></li>
              </ul>
            </div>
          </div>
        </div>
        
        </footer>
      </div>
</body>
<script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/vendors/alert.js') }}"></script>
</html>