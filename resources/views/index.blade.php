@extends('layouts.front')
@section('title', 'Get Started')

@section('content')
<section class="bg-hero pt-5" style="border-radius: 0px;">
    <div class="container">
        <div class="row mt-6">
            <div class="col-md-8 mx-auto text-center">
                <h1 class="text-white text-center" style="font-size:48px">
                    <span class="yellow-color">"</span>The funniest word-game you've ever
                        <span class="yellow-color"><strong class="u-text-animation u-text-animation--typing"></strong></span>
                    <span class="yellow-color">"</span>
                </h1>
            </div>
            <div class="col-md-8 mx-auto text-center">
                <h4 class="pt-5 text-white text-center">How to Play</h4>
                    <p class="text-white" style="margin-bottom:2px"><i class="fa fa-square"></i> You will see a <strong>form</strong></p>
                    <p class="text-white" style="margin-bottom:2px"><i class="fa fa-square"></i> Fill the form with the <strong>silliest</strong> words</p>
                    <p class="text-white"><i class="fa fa-square"></i> Click submit and get your own <strong>Crazy Story</strong></p>
                <a href="{{ route('story.play') }}" class="btn btn-lg btn-pink">
                    Play Now!
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('vendor:scripts')
    <script src="{{ asset('assets/front/js/typed.js') }}"></script>
@endsection

@section('page:scripts')
<script type="text/javascript">
    $(document).ready(function(){
 // initialization of text animation (typing)
    var typed = new Typed(".u-text-animation.u-text-animation--typing", {
        strings: ["Tied.", "Spanked.", "Kissed.", "Swallowed.", "Played."],
        typeSpeed: 60,
        loop: true,
        backSpeed: 25,
        backDelay: 1500
    });
 });
</script>
@endsection
