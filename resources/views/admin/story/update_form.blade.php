@extends('layouts.admin')
@section('title', 'Update Story Form')
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
                <h3 class="block-title">Update Story Form</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.story.form.update', $story->id) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                @foreach($formInputs as $key => $input)
                <div class="form-group">
                    {{-- form_0_new_city becomes New city. The 'form_0_' part is trimmed off and the underscore is replaced with spaces --}}
                    <label for="title">{{ ucfirst(str_replace('_', ' ', ltrim($key, "form_'.$loop->index.'_"))) }}</label>
                    <input  type="text" class="form-control" name="{{ $key }}" value="{{ $input }}" required>
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
