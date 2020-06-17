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
                        data-url="{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8"
                        src="{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8"
                >
                </video>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>

        $(window).on('load', function () {
            var isLoading = false;
            var video = document.getElementById('my-video');

            var url = "{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8";
            if (Hls.isSupported()) {
                var config = {
                    autoStartLoad: true,
                    maxBufferSize: 1 * 1000 * 1000,
                    manifestLoadingMaxRetry: 300000,
                    manifestLoadingMaxRetryTimeout: 1000,
                    levelLoadingMaxRetry: 300000,
                    levelLoadingMaxRetryTimeout: 1000,
                    fragLoadingMaxRetry: 300000,
                    fragLoadingMaxRetryTimeout: 1000
                };

                var config = {
                    "maxBufferSize": 0,
                    "maxBufferLength": 30,
                    "liveSyncDuration": 30,
                    "liveMaxLatencyDuration": Infinity
                };
                var hls = new Hls(config);

                let retrying = false;


                hls.loadSource(url);
                hls.attachMedia(video);
                hls.on(Hls.Events.MANIFEST_PARSED, function () {
                    video.play();

                });
                video.addEventListener('play', function() {
                    video.currentTime = video.duration -1;
                }, {once: true});

                hls.on(Hls.Events.ERROR, function (event, data) {
                    if (data.fatal) {
                        switch(data.type) {
                            case Hls.ErrorTypes.NETWORK_ERROR:
                                // try to recover network error
                                console.log("fatal network error encountered, try to recover");
                                hls.startLoad();
                                break;
                            case Hls.ErrorTypes.MEDIA_ERROR:
                                console.log("fatal media error encountered, try to recover");
                                hls.recoverMediaError();
                                break;
                            default:
                                // cannot recover
                                hls.destroy();
                                break;
                        }
                    }
                });
            }

            function retryLiveStream(hls, url) {
                retrying = true;
                hls.loadSource(url);
                hls.startLoad();
            }

            /*
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
                videoplayer.createModal('Retrying connection');
                /*

                                    console.log('error code 4 detected');
                                    videoplayer.retryLock = setTimeout(() => {
                                        videoplayer.src({
                                            src: "{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8"
                        });
                        videoplayer.reload();
                    }, 5000);


            });
*/
        });
    </script>
@endsection