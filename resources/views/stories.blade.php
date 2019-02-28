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
                <div class="row mt-5">
                    @foreach($stories->chunk(10) as $items)
                    <div class="col-md-6">
                        <div class="list-group">
                          @foreach($items as $item)
                          <a href="{{ route('story.select', $item->id) }}" class="list-group-item list-group-item-action">
                            {{ $item->title }}
                          </a>
                          @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

@endsection

