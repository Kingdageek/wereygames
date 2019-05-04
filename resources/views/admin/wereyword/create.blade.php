@extends('layouts.admin')
@section('title', 'New Wereyword')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wereywords.fileCreate') }}" class="btn btn-sm btn-secondary float-right">
        <i class="fa fa-file text-success mr-5"></i>New Wereyword Batch
    </a>
    <a href="{{ route('admin.wereywords.index') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Wereywords
    </a>
    New Wereyword
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">New Wereyword</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.wereywords.store') }}" method="post">

                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Wereyword name" required>
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
