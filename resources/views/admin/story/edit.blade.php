@extends('layouts.admin')
@section('title', 'Edit Story')
@section('nav_class', 'page-header-modern')
@section('custom:styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/wereyimages.css') }}">
@endsection
@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.stories') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Stories
    </a>
    Edit Story
  </h2>

  <div class="row">
    <div class="col-md-12">
      @include('admin.partials._alerts')
        <div class="block form-fit">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Story - {{ $story->title }}</h3>
             </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="{{ route('admin.stories.updateStory', $story->id) }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input  type="text" class="form-control" name="title" value="{{ $story->title }}" placeholder="Title" required>
                            </div>

                            <div class="form-group">
                                <label>Content</label>
                                <textarea class="form-control" name="content" rows="10" placeholder="Content.." required>{{ $story->content }}</textarea>
                            </div>
                            <input type="hidden" name="image" id="imageId" value="{{ $story->wereyimage_id }}">
                            <div class="form-group">
                                <button type="submit" class="btn btn-alt-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <div class="inImage" style="background-image: url({{ asset( $story->wereyimage->path ) }})">
                            <div class="cdx">
                                <button type="button" data-toggle="modal" data-target="#imagesModal" id="photoBtn"><i class="fa fa-image"></i> <span id="photoBtnText">Choose Image</span></button>
                            </div>
                            <label id="skiLabx" style="margin-top:20px;"></label>
                        </div>
                    </div>
                </div>

                <form id="myform1" action="{{ route('admin.wereyimages.process') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="cc" style="display:none;" name="image">
                </form>
            </div>
        </div>
    </div>
  </div>

</div>
@endsection

@section('page:modals')
    <!-- Modal -->
    <div class="modal fade" id="imagesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel">Select Image Thumbnail</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select an image or click "upload image" to choose from your computer. Uploaded image will be added to Wereyimages.</p>
                    <div class="imagesLoadx">
                        <div class="uploadImg sky1">
                            <span class="fa fa-upload"></span>
                            <p>Upload Image</p>
                        </div>
                        @foreach ($wereyimages as $wereyimage)
                            <div class="img" onclick="presetInput({{ $wereyimage->id }}, '{{ asset($wereyimage->path) }}')" style="background-image:url({{ asset($wereyimage->path) }});"></div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page:scripts')
<script type="text/javascript" src="{{ asset('assets/admin/js/wereyimages.js') }}"></script>
@endsection

@section('vendor:scripts')
<script src="{{ asset('assets/admin/js/plugins/jquery-form/jquery-form.min.js') }}"></script>
@endsection
