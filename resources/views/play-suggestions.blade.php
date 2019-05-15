@extends('layouts.form')
@section('title', $story->title)
@section('play-link', route('story.play'))
@section('play-title', 'Fill in your own silly words')
@section('play-btn-text', 'No suggestions')
@section('content')

<section class="py-6 form-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto text-center text-white">
                        <h2>{{ $story->title }}</h2>
                        <p class="lead">
                            FILL THIS FORM, MAKE IT AS SILLY AS YOU CAN
                        </p>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-8 mx-auto">
                    <form class="play-game text-white" action="{{ route('story.generate', $story->id) }}" method="post">

                           @csrf

                            <div class="row">
                                @foreach($formInputs as $key => $formInput)
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="{{ $key }}"><strong>{{ $formInput['wordgroup'] }}</strong></label>
                                        {{-- <input type="text" id="{{ $key }}" name="{{ $key }}" class="form-control" placeholder="{{ $input }}" required> --}}
                                        <select name="{{ $key }}" id="{{ $key }}" class="form-control" style="height: calc(3rem + 6px)" required>
                                            @foreach ($formInput['suggestions'] as $suggestion)
                                                <option value="{{ $suggestion }}">{{ $suggestion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="text-center mt-3">
                                <button class="btn btn-pink" data-size="sm" data-effect-parameter="horz-side">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
@endsection

@section('vendor:styles')
    <link rel="stylesheet" href="{{ asset('assets/front/css/foxholder.min.css') }}">
@endsection

@section('vendor:scripts')
    <script src="{{ asset('assets/front/js/foxholder.min.js') }}"></script>
@endsection

@section('page:scripts')
<script type="text/javascript">
$(document).ready(function(){
    jQuery('.play-game').foxholder({
    placeholderDemo: 6,
    buttonDemo: 6
  });
});
</script>
@endsection
