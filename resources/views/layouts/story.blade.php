<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}
    <link href="https://fonts.googleapis.com/css?family=Karla:400,400i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/fakeLoader.min.css') }}">
    @yield('vendor:styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/custom.css') }}">
    @yield('page:styles')
</head>
<body>
    <!--navigation-->
    <section class="bh-white py-3 story-header">
        <div class="container-fluid">
            <div class="row">
                 <div class="col-12 d-flex flex-row align-items-center justify-content-between">
                    <a href="{{ route('front.index') }}" style="padding-left: 30px; padding-top: 30px">
                        <img src="{{ asset('assets/front/img/logo-white.png') }}" width="130px">
                    </a>
                </div>
            </div>
        </div>
    </section>

   @yield('content')

   <!--footer-->
    <footer class="py-5 story-bg">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <ul class="list-inline">
                        <li class="list-inline-item"><a class="text-white" href="{{ route('get.stories') }}">Stories</a></li>
                        <li class="list-inline-item"><a class="text-white" href="{{ route('front.about') }}">About</a></li>
                    </ul>
                </div>
            </div>
            <div class="row my-2">
                <div class="col-md-4 mx-auto text-muted text-center small-xl">
                    &copy; {{ date('Y') }} Werey Games
                </div>
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.7.0/feather.min.js"></script>
    <script src="{{ asset('assets/front/js/fakeLoader.min.js') }}"></script>
    @yield('vendor:scripts')
    <script src="{{ asset('assets/front/js/scripts.js') }}"></script>
    <script>
    $(document).ready(function(){
        $.fakeLoader({
            timeToHide:1200,
            bgColor:"#1abc9c",
            spinner:"spinner6"
            });
        });
    </script>
    <div class="fakeLoader"></div>
    @yield('page:scripts')
    </body>
</html>
