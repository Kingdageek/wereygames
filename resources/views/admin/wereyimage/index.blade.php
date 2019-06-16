@extends('layouts.admin')
@section('title', 'Manage wereyimages')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wereyimages.create') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>New Wereyimage
    </a>
   Manage Wereyimages
</h2>
    @include('admin.partials._alerts')

    <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Wereyimages</h3>
   </div>
   <div class="block-content">
       @if ( ! $wereyimages->isEmpty() )
        <div class="table-responsive">
                <table class="table table-striped table-vcenter">
                    <thead>
                            <tr>
                                <th>Image</th>
                                <th>Associated Stories</th>
                                <th>Added</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($wereyimages as $wereyimage)
                            <tr>
                                <td><img src="{{ asset($wereyimage->path) }}" style="width:200px;height:200px;border-radius:5px;"></td>
                                <td class="font-w600">{{ $wereyimage->stories->count() }}</td>
                                <td class="font-w600">{{ $wereyimage->created_at->toFormattedDateString() }}</td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ route('admin.wereyimages.edit', $wereyimage->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                            <i class="fa fa-pencil"></i> Change
                                        </a>
                                        <form action="{{ route('admin.wereyimages.destroy', $wereyimage->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete" onclick="confirm('If you delete this, all stories that use the image will have no image, you will be responsible for updating each of them with new images. Sure to delete this wereyimage?') ? '' : event.preventDefault();"><i class="fa fa-trash"></i> Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $wereyimages->render() !!}
                </div>
            @else
                <p>No wereyimage created yet. <a href="{{ route('admin.wereyimages.create') }}">Create wereyimage</a></p>
            @endif
        </div>
    </div>
</div>
@endsection
