@extends('layouts.admin')
@section('title', 'Settings')
@section('nav_class', 'page-header-modern')

@section('content')
<div class="content">
   <h2 class="content-heading">
    Settings
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">Settings</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.settings.update') }}" method="post">

                @csrf
                <div class="form-group">
                    <label for="name">Number of wereyword hints</label>
                    <input  type="number" class="form-control" name="wereyword_hints" value="{{ $settings->wereyword_hints }}" required max="10" min="3">
                </div>

                <div class="form-group">
                    <label for="name">Beta Mode <input type="checkbox" name="beta_mode" id="beta_mode" {{ ( $settings->beta_mode ) ? 'checked' : '' }}>
                    </label>
                </div>

               <div class="form-group">
                  <button type="submit" class="btn btn-alt-primary">Update settings</button>
               </div>
            </form>
          </div>
       </div>
    </div>
  </div>

</div>
@endsection
