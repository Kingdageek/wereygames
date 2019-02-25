@extends('layouts.front')
@section('title', $story->title)

@section('content')

    <section class="py-7 main-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <h2 class="text-capitalize">{{ $story->title }}</h2>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-6 ml-auto">
                       {!! nl2br($formedStory) !!}
                    </div>
                </div>
            </div>
        </section>

@endsection
