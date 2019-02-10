@extends('layouts.front')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"></div>
                <div class="card-body">
                <form action="{{ route('front.start', $story->id) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                @foreach($formInputs as $key => $input)
                <div class="form-group">
                    <label for="title">{{ ucfirst($input) }}</label>
                    <input  type="text" class="form-control" name="{{ $input }}" placeholder="Enter example placeholder" required>
                </div>
                @endforeach

               <div class="form-group">
                  <button type="submit" class="btn btn-alt-primary">Submit</button>
               </div>
            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
