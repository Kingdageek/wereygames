@extends('layouts.front')
@section('title', 'Get Started')

@section('content')
<section class="bg-hero pt-5" style="border-radius: 0px;">
    <div class="container">
        <div class="row mt-6">
            <div class="col-md-7 mx-auto text-center">
                <h1 class="text-white display-4">
                    <blockquote class="curly-quotes">The funniest word-game you've ever
                        <span class="yellow-color"><strong class="u-text-animation u-text-animation--typing"></strong></span>
                    </blockquote>
                </h1>
                <h4 class="pt-5 text-white">How to Play</h4>
                <ul>
                    <li class="text-white">You will see a <strong>form</strong></li>
                    <li class="text-white">Fill the form with the <strong>silliest</strong> words</li>
                    <li class="text-white">Click submit and get your own <strong>Crazy Story</strong></li>
                </ul>
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
