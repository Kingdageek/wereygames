@extends('layouts.admin')
@section('title', 'New Wordgroup')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wordgroups.index') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Wordgroups
    </a>
    New Wordgroup
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">New Wordgroup</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.wordgroups.store') }}" method="post">

                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Wordgroup name" required>
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
