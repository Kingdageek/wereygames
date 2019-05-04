@extends('layouts.admin')
@section('title', 'Generate Story Form')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.stories') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Stories
    </a>
     {{ $story->title }}
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Generate Story Form</h3>
             </div>
            <div class="block-content">
            @if(!empty($formInputs))
            <form action="{{ route('admin.story.form', $story->id) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                @foreach($formInputs as $key => $value)
                <div class="form-group">
                    <label for="title">{{ ucfirst($value) }}</label>
                    <input  type="text" class="form-control" name="form_{{ $key }}_{{ preg_replace('/\s+/', '_', $value) }}" placeholder="Enter example placeholder" required>
                </div>
                @endforeach

               <div class="form-group">
                  <button type="submit" class="btn btn-alt-primary">Submit</button>
               </div>
            </form>
            @else
            <p>This story has empty tags to build a form</p>
            @endif
          </div>
       </div>
    </div>
  </div>

</div>
@endsection
