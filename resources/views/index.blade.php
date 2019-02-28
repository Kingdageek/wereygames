@extends('layouts.front')
@section('title', 'Get Started')

@section('content')
<section class="bg-hero pt-5">
    <div class="container">
        <div class="row mt-6">
            <div class="col-md-7 mx-auto text-center">
                <h1 class="text-primary">"<span style="color:#ffffff">The funniest word-game you've ever played</span>"</h1>
                <h2 class="display-4">How to Play</h2>
                <ul>
                    <li></li>
                </ul>
                <a href="{{ route('story.play') }}" class="btn btn-danger">
                    Play Now!
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
