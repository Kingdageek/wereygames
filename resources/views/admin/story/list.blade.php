 @extends('layouts.admin')
@section('title', 'Manage Companies')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    {{-- <a href="{{ route('admin.story.create') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>New Story
    </a> --}}
    <a href="{{ route('admin.stories.createStory') }}" class="btn btn-sm btn-secondary float-right">
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
       @if ( ! $stories->isEmpty() )
       <div class="table-responsive">
            <table class="table table-striped table-vcenter">
                   <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th width="20%">Added</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stories as $story)
                        <tr>
                            <td><img src="{{ asset($story->wereyimage->path) }}" alt="{{ $story->title }}" style="width:100px;height:100px"></td>
                            <td class="font-w600">{{ $story->title }}</td>
                            <td class="font-w600">{{ $story->created_at->toFormattedDateString() }}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.stories.editStory', $story->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    {{-- <a href="{{ route('admin.story.edit', $story->id) }}" class="btn btn-sm btn-info" data-toggle="tooltip" data-original-title="Edit">
                                        <i class="fa fa-pencil"></i> Edit
                                    </a>
                                    There should always be story form unless no special tags by human
                                    --}}
                                    @if ($story->form)
                                    <a href="{{ route('admin.story.form.update', $story->id) }}" class="btn btn-sm btn-primary" data-toggle="tooltip" data-original-title="Manage Form">
                                        <i class="fa fa-pencil"></i> Update Form
                                    </a>
                                    @endif
                                    {{-- <a href="{{ route('admin.story.form', $story->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-original-title="Manage Form">
                                        <i class="fa fa-pencil"></i> Generate Form
                                    </a> --}}
                                    {{--  <a href="{{ route('admin.story.delete', $story->id) }}" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete Story" onclick="confirm('Deleting this story will delete all created user stories. Do you still want to continue?') ? '' : event.preventDefault();">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>  --}}
                                    <form action="{{ route('admin.stories.destroy', $story->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-original-title="Delete" onclick="confirm('Deleting this story will delete all created user stories. Do you still want to continue?') ? '' : event.preventDefault();"><i class="fa fa-trash"></i> Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                     </tbody>
                </table>
                {!! $stories->render() !!}
            </div>
        </div>
        @else
            <p>No stories created yet. <a href="{{ route('admin.stories.createStory') }}">Create story</a></p>
        @endif
    </div>
</div>
@endsection
