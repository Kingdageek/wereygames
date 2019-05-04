@extends('layouts.admin')
@section('title', 'Edit Wereyword - ' . $wereyword->name)
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wereywords.index') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Wereywords
    </a>
    Edit Wereyword - {{ $wereyword->name }}
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Edit Wereyword - {{ $wereyword->name }}</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.wereywords.update', [ 'wereyword' => $wereyword->id ]) }}" method="post">

                @csrf
                @method('PATCH')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input  type="text" class="form-control" name="name" value="{{ $wereyword->name }}" placeholder="wereyword name" required>
                </div>

                <div class="form-group">
                    <label for="wordgroups">Select Wordgroups</label>
                    <div class="checkbox">
                        @foreach ($wordgroups as $wordgroup)
                            <label>
                                <input type="checkbox" name="wordgroups[]" value="{{ $wordgroup->id }}" id="wordgroups"
                                {{-- To make a checkbox auto-selected if its associated with the wereyword, we
                                need to loop through all the wereyword's wordgroups and find the one that matches the current
                                wordgroup id --}}
                                @foreach ($wereyword->wordgroups as $wereyWordGroup)
                                    @if ($wereyWordGroup->id === $wordgroup->id)
                                        checked
                                    @endif
                                @endforeach
                                > {{ $wordgroup->name }}
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
