@extends('layouts.admin')
@section('title', 'New Story')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.users') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Users
    </a>
    Edit Admin User
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Admin User</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.user.edit', $user->id) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="title">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name ?? old('name') }}" placeholder="Name" required>
                </div>

                <div class="form-group">
                    <label for="title">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ $user->email ?? old('email') }}" placeholder="Email" required>
                </div>

                <div class="form-group">
                    <label for="title">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>

               <div class="form-group">
                  <button type="submit" class="btn btn-alt-primary">Create</button>
               </div>
            </form>
          </div>
       </div>
    </div>
  </div>

</div>
@endsection
