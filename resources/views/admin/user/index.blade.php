@extends('layouts.admin')
@section('title', 'Manage Admin Users')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>New Admin User
    </a>
   Manage Admin Users
</h2>
    @include('admin.partials._alerts')

    <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Users</h3>
   </div>
   <div class="block-content">
       <div class="table-responsive">
            <table class="table table-striped table-vcenter">
                   <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Permissions</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class="font-w600">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('admin.users.permissions', ['id' => $user->id]) }}" method="POST" onclick="confirm('Sure to change this user\'s permissions?') ? '' : event.preventDefault()">
                                    @csrf
                                    @if ($user->is_admin)
                                        <input type="submit" value="Remove permissions" class="btn btn-sm btn-danger">
                                    @else
                                        <input type="submit" value="Make admin" class="btn btn-sm btn-primary">
                                    @endif
                                </form>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    {{--  To make sure the authenticated user cannot delete himself  --}}
                                    @if($user->id !== auth()->id())
                                    <a href="{{ route('admin.user.delete', $user->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Manage Form">
                                        <i class="fa fa-pencil"></i> Delete
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
