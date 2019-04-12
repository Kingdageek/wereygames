@extends('layouts.front')
@section('title', 'Get Started')

@section('content')
<section class="bg-hero pt-5" style="border-radius: 0px;">
    <div class="container">
        <div class="row mt-6">
            <div class="col-md-8 mx-auto text-center">
                <h1 class="text-white text-center" style="font-size:48px">
                    Coming Soon
                </h1>
            </div>
            <div class="col-md-8 mx-auto text-center">
                <h4 class="pt-5 text-white text-center">Follow us social media</h4>
                    <div class="text-center mt-5">
                       <div class="sharethis-inline-follow-buttons"></div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('vendor:scripts')
    <script src="//platform-api.sharethis.com/js/sharethis.js#property=5cb07dcd918ee800121206cc&product=inline-follow-buttons"></script>
@endsection
