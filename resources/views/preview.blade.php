@extends('layouts.story')
@section('title', $story->title)

@section('content')

    <section class="py-3 story-bg text-white">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-5">
                        <img src="{{ $story->featured_image }}" width="520px">
                    </div>
                    <div class="col-md-6 ml-auto">
                        <h2 class="text-capitalize">{{ strtoupper($story->title) }}</h2>

                       {!! nl2br($formedStory->content) !!}

                       <div class="text-center pt-2">
                            <div id="share"></div>
                            <a href="{{ route('story.play') }}" class="btn btn-lg btn-pink">
                                TRY ANOTHER
                            </a>
                            <p class="text-muted">Over <strong>100 stories</strong> to choose from</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection

@section('page:scripts')
<script type="text/javascript">
    $("#share").jsSocials({
    showCount: false,
    showLabel: false,
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
