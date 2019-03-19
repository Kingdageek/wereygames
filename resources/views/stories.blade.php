@extends('layouts.front')
@section('title', 'Select a story')

@section('content')
    <section class="py-7 main-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <h2 class="text-capitalize">All Stories</h2>
                    </div>
                </div>
                <div class="row mt-5 text-center">
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
                </div>
                <div class="row">
                    {!! $stories->render() !!}
                </div>
            </div>
        </section>

@endsection

