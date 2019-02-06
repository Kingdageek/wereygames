@extends('layouts.admin')
@section('title', 'Edit Story')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.stories') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Stories
    </a>
    Edit Story
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Story - {{ $story->title }}</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.story.edit', $story->id) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input  type="text" class="form-control" name="title" value="{{ $story->title ?? old('title') }}" placeholder="Title" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content" rows="10" placeholder="Content.." required>{{ $story->content }}</textarea>
                </div>

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
