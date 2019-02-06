<!doctype html>
<!--[if lte IE 9]>     <html lang="en" class="no-focus lt-ie10 lt-ie10-msg"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en" class="no-focus"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>@yield('title') - {{ config('app.name', 'Upskill') }}</title>

        <meta name="description" content="Ideas collaboration platform">
        <meta name="author" content="netaviva">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicons/favicon.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/admin/images/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/admin/images/favicons/apple-touch-icon-180x180.png') }}">
         @yield('vendor:styles')
        <link rel="stylesheet" id="css-main" href="{{ asset('assets/admin/css/core.min.css') }}">
    </head>
    <body>
      <div id="page-container" class="main-content-boxed">
            <main id="main-container">

                @yield('content')

            </main>
        </div>

        <script src="{{ asset('assets/admin/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/core/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/core/jquery.slimscroll.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/core/jquery.scrollLock.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/core/jquery.appear.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/core/jquery.countTo.min.js') }}"></script>
        <script src="{{ asset('assets/admin/js/core/js.cookie.min.js') }}"></script>
        @yield('vendor:scripts')
        <script src="{{ asset('assets/admin/js/core.js') }}"></script>

        @yield('page:scripts')

        @stack('scripts')

    </body>
</html>
