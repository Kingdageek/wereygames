@extends('layouts.admin')
@section('title', 'Manage Companies')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.story.create') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>New Story
    </a>
   Manage Stories
</h2>
    @include('admin.partials._alerts')

    <div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title">Stories List</h3>
   </div>
   <div class="block-content">
       <div class="table-responsive">
            <table class="table table-striped table-vcenter">
                   <thead>
                        <tr>
                            <th>Title</th>
                            <th width="20%">Added</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stories as $story)
                        <tr>
                            <td class="font-w600">{{ $story->title }}</td>
                            <td>{{ $story->created_at }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.story.edit', $story->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    <a href="{{ route('admin.story.form', $story->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="Manage Form">
                                        <i class="fa fa-pencil"></i> Form
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                </table>
                {!! $stories->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
