@extends('layouts.front')
@section('title', 'Unlock more games')

@section('content')

    <section class="py-7 main-bg">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-7 mx-auto text-center">
                        <h2 class="text-capitalize text-white">PICK A STORY</h2>
                    </div>
                </div>
                <div class="row mt-5 my-auto mx-auto text-center">
                  <div class="to-lock" style="width:100%; text-align: center;">
                   @foreach($stories->chunk(2) as $chunk)
                   <div class="row">
                        @foreach($chunk as $story)
                          <div class="col-md-6">
                            <a href="{{ route('story.select', $story->id) }}" class="list-group-item list-group-item-action">
                              {{ $story->title }}
                            </a>
                          </div>
                          @endforeach
                    </div>
                    @endforeach
                  </div>
                </div>
            </div>
    </section>

@endsection

@section('page:styles')
<link rel="stylesheet" href="{{ asset('assets/front/css/locker.css') }}">
@endsection
@section('vendor:scripts')
<script src="{{ asset('assets/front/js/jquery.ui.highlight.min.js') }}"></script>
<script src="{{ asset('assets/front/js/locker.min.js') }}"></script>
@endsection
@section('page:scripts')

<script type="text/javascript">
jQuery(document).ready(function ($) {
   $.pandalocker.hooks.add( 'opanda-unlock', function(e, locker, sender){
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
         });
        $.ajax({
            url: '/unlock',
            type:'POST',
            dataType: 'json',
            success: function(output_string){
                console.log('The content was unlocked via: ' + sender + "!");
            } // End of success function of ajax form
        }); // End of ajax call
    });
   $('.to-lock').sociallocker({
    demo: false,
    text:{
       header: 'Over 100 Stories to choose from',
       message: 'To unlock, perform any of the actions below'
    },
    theme: 'glass',
    overlap:{
      mode:'transparence',
      intensity: '0'
    },
    facebook:{
       like:{
          url: 'https://facebook.com/codulab',
          title: 'Like WereyGames'
       }
    },
    twitter:{
       tweet:{
          url: 'https://weregames.com',
          text: 'The funniest word-game you have ever played',
          via: 'wereygames',
          title: 'Tweet'
       },
       follow:{
          url: 'https://twitter.com/stanwarri',
          title: 'Follow Us'
       }
    },
    buttons:{
       order: ["facebook-like","twitter-tweet","twitter-follow"],
       counters: false,
       lazy: true
    }
   });
});
</script>
@endsection
