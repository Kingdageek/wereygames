@extends('layouts.front')
@section('title', $story->title)

@section('content')

<section class="py-6 main-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto text-center">
                        <h2 class="display-4">{{ $story->title }}</h2>
                        <p class="lead">
                            FILL THIS FORM, MAKE IT AS SILLY AS YOU CAN
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8 mx-auto">
                    <form action="{{ route('story.generate', $story->id) }}" method="post" enctype="multipart/form-data">

                           {{ csrf_field() }}

                            <div class="row">
                                @foreach($formInputs as $key => $input)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="{{ $key }}">{{ strtok($input, " ") }}</label>
                                        <input type="text" name="{{ $key }}" class="form-control" placeholder="{{ substr(strstr($input,' '), 1) }}" required>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-danger">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

@endsection
