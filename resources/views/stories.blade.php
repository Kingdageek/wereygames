@extends('layouts.front')
@section('title', 'Select a story')

@section('content')
    <section class="py-7 main-bg mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <h2 class="text-capitalize text-white">PICK A STORY</h2>
                    </div>
                </div>

                   @foreach($stories->chunk(3) as $chunk)
                   <div class="row">
                        @foreach($chunk as $story)
                          <div class="col-md-4 text-center">
                            <a href="{{ route('story.select', $story->id) }}" class="text-white">
                              {{ $story->title }}
                            </a>
                          </div>
                          @endforeach
                    </div>
                    @endforeach

                <div class="row">
                    {!! $stories->render() !!}
                </div>
            </div>
        </section>

@endsection

