<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta http-equiv="x-ua-compatible" content="ie=edge" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="{{ asset('assets/css/main.css?v=6.0') }}" rel="stylesheet" type="text/css" />
        @yield('css')
        <style>

            body{
                background: #f8f9fa !important;
            }
            button{
                width: 200px !important;
                height: 50px !important;
                border-radius: 5rem !important;
                text-align: center !important;
                display: block !important;
            }
            .btn{
                display: block !important;
                width: 200px !important;
                height: 50px !important;
                border-radius: 5rem !important;
            }
        </style>
    </head>

    <body>
        <x-alert/>
        <main>
           @yield('content')
        </main>
    </body>
    <script src="{{ asset('assets/js/vendors/color-modes.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/jquery.fullscreen.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendors/chart.js') }}"></script>
    <script src="{{ asset('assets/js/main.js?v=6.0') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/custom-chart.js') }}" type="text/javascript"></script>
    @yield('scripts')
</html>
