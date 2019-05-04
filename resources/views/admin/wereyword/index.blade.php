@extends('layouts.admin')
@section('title', 'Manage Wereywords')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wereywords.fileCreate') }}" class="btn btn-sm btn-secondary float-right">
        <i class="fa fa-file text-success mr-5"></i>New Wereyword Batch
    </a>
    <a href="{{ route('admin.wereywords.create') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>New Wereyword
    </a>
   Manage Wereywords
</h2>
    @include('admin.partials._alerts')

    <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Wereywords</h3>
   </div>
   <div class="block-content">
       @if ( ! $wereywords->isEmpty() )
        <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                            <tr>
                                <th>Name</th>
                                <th>Wordgroups</th>
                                <th>Added</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wereywords as $wereyword)
                            <tr>
                                <td class="font-w600">{{ $wereyword->name }}</td>
                                <td class="font-w600">{{ $wereyword->wordgroups->count() }}</td>
                                <td class="font-w600">{{ $wereyword->created_at->toFormattedDateString() }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.wereywords.edit', $wereyword->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.wereywords.destroy', $wereyword->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete" onclick="confirm('Sure to delete this Wereyword?') ? '' : event.preventDefault();"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $wereywords->render() !!}
                </div>
            @else
                <p>No wereyword created yet. <a href="{{ route('admin.wereywords.create') }}">Create wereyword</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
