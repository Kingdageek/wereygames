@extends('layouts.admin')
@section('title', 'Manage Wordgroups')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wordgroups.create') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>New Wordgroup
    </a>
   Manage Wordgroups
</h2>
    @include('admin.partials._alerts')

    <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Wordgroups</h3>
   </div>
   <div class="block-content">
       @if ( ! $wordgroups->isEmpty() )
        <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                            <tr>
                                <th>Name</th>
                                <th>Wereywords</th>
                                <th>Added</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wordgroups as $wordgroup)
                            <tr>
                                <td class="font-w600">{{ $wordgroup->name }}</td>
                                <td class="font-w600">{{ $wordgroup->wereywords->count() }}</td>
                                <td class="font-w600">{{ $wordgroup->created_at->toFormattedDateString() }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.wordgroups.edit', $wordgroup->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.wordgroups.destroy', $wordgroup->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete" onclick="confirm('Sure to delete this Wordgroup?') ? '' : event.preventDefault();"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $wordgroups->render() !!}
                </div>
            @else
                <p>No wordgroup created yet. <a href="{{ route('admin.wordgroups.create') }}">Create Wordgroup</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
