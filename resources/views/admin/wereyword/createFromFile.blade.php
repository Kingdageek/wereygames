@extends('layouts.admin')
@section('title', 'Create Wereywords from file')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wereywords.create') }}" class="btn btn-sm btn-secondary float-right">
        <i class="fa fa-check text-success mr-5"></i>New Wereyword
    </a>
    <a href="{{ route('admin.wereywords.index') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Wereywords
    </a>
    New Wereyword Batch
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">New Wereyword Batch</h3>
             </div>
            <div class="block-content">
                <p><small>* The batch operation may take a little while depending on the size of the file</small></p>
            <form action="{{ route('admin.wereywords.fileStore') }}" method="post" enctype="multipart/form-data">

                @csrf

                <div class="form-group">
                    <label>Wereywords file <small>(.csv, .txt only)*</small></label>
                    <div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input js-custom-file-input-enabled" id="example-file-input-custom" name="wereywordsFile" data-toggle="custom-file-input">
                            <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="wordgroups">Select Wordgroups</label>
                    <div class="checkbox">
                        @foreach ($wordgroups as $wordgroup)
                            <label style="padding-right:.2em">
                                <input type="checkbox" name="wordgroups[]" value="{{ $wordgroup->id }}" id="wordgroups"> {{ $wordgroup->name }}
                            </label>
                        @endforeach
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
