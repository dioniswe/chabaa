@extends('layouts.neutral')


@section('content')


    <div class="flex-center ">
        <iframe src="{{url(request()->getSchemeAndHttpHost() . ':8008/' . config('chaba.ICECAST_MOUNT_NAME'))}}" id="iframeAudio"></iframe>
    </div>

@endsection

@section('javascript')

<script>
    /* TODO direct embedding through <audio> does not work everywhere ( in chrome? ) Make sure the correct alternative is chosen
    document.ready(function() {
        var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        if (!isChrome) {
            $('#iframeAudio').remove()
        } else {
            $('#playAudio').remove() // just to make sure that it will not have 2x audio in the background
        }
    });
*/
</script>

@endsection