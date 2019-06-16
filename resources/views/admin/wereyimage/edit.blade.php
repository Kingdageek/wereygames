@extends('layouts.admin')
@section('title', 'New Wereyimage')
@section('nav_class', 'page-header-modern')
@section('custom:styles')
<link rel="stylesheet" href="{{ asset('assets/admin/css/wereyimages.css') }}">
@endsection
@section('content')
<div class="content">
   <h2 class="content-heading">
    <a href="{{ route('admin.wereyimages.index') }}" class="btn btn-sm btn-secondary float-right">
       <i class="fa fa-check text-success mr-5"></i>Manage Wereyimages
    </a>
    New Wereyimage
  </h2>

  <div class="row">
    <div class="col-md-8 offset-md-2">
      @include('admin.partials._alerts')
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">New Wereyimage</h3>
             </div>
            <div class="block-content">
            <form action="{{ route('admin.wereyimages.update', [ 'wereyimage' => $wereyimage->id ]) }}" method="post" enctype="multipart/form-data" class="text-center">
                @method('PATCH')
                {{ csrf_field() }}
                <div class="inImage" style="margin:auto;" id="preview">
                    <div class="cdx">
                        <button type="button" class="sky1"><span class="fa fa-image"></span> Change Image</button>
                    </div>
                    <label id="skiLabx" style="margin-top:20px;"></label>
                </div>

                <input type="file" id="image" style="display:none;" name="image">

               <div class="form-group">
                  <button type="submit" class="btn btn-alt-primary" style="margin-top:1rem;">Update Image</button>
               </div>
            </form>
          </div>
       </div>
    </div>
  </div>

</div>
@endsection

@section('page:scripts')
<script type="text/javascript">

    function previewImage(input) {
        if (input.files && input.files[0]) {
            let freader = new FileReader();
            freader.onload = function (e) {
                $('#preview').css('background-image', 'url("' + e.target.result + '")')
                $(".cdx").css({"background":"rgba(0,0,0,.3)"});
                $(".sky1").html('<i class="fa fa-image"></i> Change photo');
            }
            freader.readAsDataURL(input.files[0]);
        }
    }

    $("#image").change(function(){
        previewImage(this);
    })

   $(function(){
       $('#preview').css('background-image', 'url("{{ asset($wereyimage->path) }}")')
       $(".cdx").css({"background":"rgba(0,0,0,.3)"})
       $(".sky1").click(function(){
           $("#image").click();
       });
    });
</script>
@endsection

@section('vendor:scripts')
<script src="{{ asset('assets/admin/js/plugins/jquery-form/jquery-form.min.js') }}"></script>
@endsection
