@extends('layouts.front')
@section('title', $story->title)

@section('content')

    <section class="py-7 main-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <h2 class="text-capitalize">{{ $story->title }}</h2>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-5">
                        <img src="{{ $story->featured_image }}" width="520px">
                    </div>
                    <div class="col-md-6 ml-auto">
                       {!! nl2br($formedStory->content) !!}
                       <div id="share"></div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('page:scripts')
<script type="text/javascript">
    $("#share").jsSocials({
    showCount: false,
    showLabel: true,
    shares: [
        "twitter",
        { share: "facebook", label: "Share" },
        "linkedin",
        { share: "pinterest", label: "Pin this" },
        "whatsapp"
    ]
});
</script>

@endsection
