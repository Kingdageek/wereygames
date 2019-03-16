@extends('layouts.story')
@section('title', $story->title)

@section('content')

    <section class="py-3 story-bg text-white">
            <div class="container">
                <div class="row mt-5">
                    <div class="col-md-5">
                        <img src="{{ $story->featured_image }}" class="img-fluid d-block mx-auto">
                    </div>
                    <div class="col-md-6 ml-auto">
                        <h2 class="text-capitalize">{{ strtoupper($story->title) }}</h2>

                       {!! nl2br($formedStory->content) !!}

                       <div class="text-center mt-5">
                            <div style="margin-bottom:-40px">Share on your story on</div>
                            <div id="share" class="mt-5 mb-3"></div>
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
    text: "{{ $socialShare }} || Lmao you need to try this! Visit www.wereygames.com to create your own #WereyStory",
    showCount: false,
    showLabel: false,
    shares: [
        "twitter",
        { share: "facebook", label: "Share" },
        "whatsapp"
    ]
});
</script>

@endsection
