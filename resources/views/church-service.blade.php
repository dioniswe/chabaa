@extends('layouts.neutral')


@section('head')

@endsection

@section('content')
    <div class="container" id="church-service" data-channel-prefix="{{config("database.redis.options.prefix")}}">
        <div class="row">
            <div class="col-lg-4">
                <div class="chat-container">
                    <div class="col-sm-12 message_section">
                        <div class="row">
                            <div class="new_message_head">
                                {{__('prayer requests')}}, {{__('salutations')}}, {{__('messages')}}
                            </div>
                            <chat-messages v-on:messageinitialize="getMessages" :messages="messages" ref="messageFrame"></chat-messages>
                            <chat-form
                                    v-on:messagesent="addMessage"
                                    :user="{{ Auth::user() }}"
                            ></chat-form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 flex-center">
                <video
                        id="my-video"
                        class="video-js"
                        controls
                        preload="auto"
                        width="800"
                        height="450"
                        data-setup='{}'
                >
                    <source src="{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8"
                            type="application/x-mpegURL"/>
                    <p class="vjs-no-js">
                        {{__('messages.unable_to_play_video_message')}}
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
/*
        $(window).on('load', function () {

            console.log("ready!");

            var videoplayer = videojs('my-video');
            videoplayer.reloadSourceOnError({
                // errorInterval specifies the minimum amount of seconds that must pass before
                // another reload will be attempted
                errorInterval: 5
            });
            videoplayer.on('play', () => {
                console.log('playing');
            });

            videoplayer.on('error', () => {

                console.log('this is an emergency!');

                console.log(videoplayer.error());
                videoplayer.createModal('Retrying connection');
                console.log('error code 4 detected');
                videoplayer.retryLock = setTimeout(() => {
                    videoplayer.src({
                        src: "{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8"
                    });
                videoplayer.reload();
                }, 5000);
            });
        });
        */
    </script>
@endsection