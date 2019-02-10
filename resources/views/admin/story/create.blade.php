@extends('layouts.admin')
@section('title', 'New Story')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.stories') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Stories
    </a>
    New Story
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">New Story</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.story.create') }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Title</label>
                    <input  type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Title" required>
                </div>

                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content" rows="10" placeholder="Content.." required></textarea>
                </div>

                <div class="form-group">
                <label class="col-12">Featured Image</label>
                  <div class="col-12">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input js-custom-file-input-enabled" id="example-file-input-custom" name="featured_image" data-toggle="custom-file-input">
                        <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                    </div>
                  </div>
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
