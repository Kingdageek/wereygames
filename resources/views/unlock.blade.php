@extends('layouts.front')
@section('title', 'Unlock more games')

@section('content')

    <section class="py-7 main-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 mx-auto text-center">
                        <h2 class="text-capitalize">Unlock to Play</h2>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6 offset-md-3">
                     <div class="to-lock" style="text-align: center;">
                        <a href="{{ route('get.stories') }}" class="btn btn-danger">
                            Play More Games!
                        </a>
                     </div>
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
   $('.to-lock').sociallocker({
    demo: true,
    text:{
       header: 'Interesting Games?',
       message: 'Please support us, use one of the buttons below to unlock more story games'
    },
    theme: 'flat',
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
