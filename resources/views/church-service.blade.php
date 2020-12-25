@extends('layouts.neutral-including-app-js')


@section('head')
    <script src="https://cdn.bootcss.com/flv.js/1.5.0/flv.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-flash@2/dist/videojs-flash.min.js"></script>
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
                            <chat-messages v-on:messageinitialize="getMessages" :messages="messages"
                                           ref="messageFrame"></chat-messages>
                            <chat-form
                                v-on:messagesent="addMessage"
                                :user="{{ Auth::user() }}"
                            ></chat-form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 ">
                <div class="row">
                    <!------------------- seeking connection --------------------->
                    <div class="col-sm-11" id="seeking-connection">
                        <div class="img-overlay-wrap">
                            <img class="img-overlay-wrap-spinner" src="images/loading-transparent.gif" width="150"
                                 height="150">
                        </div>

                        <div style="text-align:center; font-size: 18px" size="20">Es wird nach einer
                            Predigtübertragung (Stream) gesucht
                        </div>
                    </div>
                    <!------------------- connection not found --------------------->
                    <div class="col-sm-11 d-none" id="connection-not-found">

                        <div class="img-overlay-wrap">

                            <img id="rectangle" src="images/svg/rectangle-frame.svg" width="100%">

                            <span class="img-overlay-wrap-unsuccessful-right">
                                    <img width="65" src="images/testbild_rund.png">
                                </span>
                            <span class="img-overlay-wrap-unsuccessful-middle"
                                  style="font-size: 48px; color: #5cb85c; text-align: center">
                                    <i class="fas fa-lg  fa-hand-point-right"></i>
                                </span>
                            <span class="img-overlay-wrap-unsuccessful"
                                  style="font-size: 48px; color: #5cb85c; text-align: center">
                                    <i class="fas fa-lg  fa-flushed"></i>
                                </span>
                            <!--img class="img-overlay-wrap-img" src="images/dailyverses/de/1-johannes-3-11.jpg" width="345" height="250"-->

                            <div class="rectangle-text">
                                <div style="text-align:center; font-size: 18px" size="20"> Aktuell gibt es (noch) keine
                                    Predigtübertragung. Es wird in
                                </div>
                                <div style="text-align:center; font-size: 24px" size="20" id="countdown">30</div>
                                <div style="text-align:center; font-size: 18px" size="20">Sekunden erneut nach einer
                                    Übertragung gesucht
                                </div>
                            </div>
                        </div>


                    </div>
                    <!------------------- connection found --------------------->
                    <div class="col-sm-11 d-none" id="connection-found">
                        <div class="img-overlay-wrap">
                            <svg width="645" height="365">
                                <rect width="640" height="360" x="2" y="2" rx="4" fill-opacity="0"
                                      stroke-opacity="0.5"
                                      style="fill:rgb(255,255,255);stroke-width:2;stroke:rgb(180,180,180);"/>
                            </svg>

                            <span class="img-overlay-wrap-unsuccessful"
                                  style="font-size: 48px; color: royalblue; text-align: center">
                            <i class="fas fa-lg fa-blue fa-smile-beam"></i>
                            </span>
                            <!--img class="img-overlay-wrap-img" src="images/dailyverses/de/1-johannes-3-11.jpg" width="345" height="250"-->
                        </div>
                        <div style="text-align:center; font-size: 18px" size="20">Predigtübertragung gefunden, einen
                            Moment noch...
                        </div>

                    </div>
                </div>
                <div class="flex-center">
                    @if($isFlashVideoSetting)
                        <video
                            id="my-flash-video"
                            width="640"
                            height="264"
                        >

                            <source src="{{$flashVideoSource}}">
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a
                                web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank"
                                >supports HTML5 video</a
                                >
                            </p>
                        </video>
                        <!-- data-poster="https://www.chip.de/ii/5/6/7/6/2/8/4/8/43dff6dc96b32060.jpeg" -->

                    @else
                    <!--TODO: Bitte auf das Video drücken, falls nicht automatisch abgespielt wird -->
                        <!-- data-poster="https://www.chip.de/ii/5/6/7/6/2/8/4/8/43dff6dc96b32060.jpeg" -->
                        <video
                            id="my-html5-video"
                            source="{{$videoSource}}"
                        >
                        </video>
                    @endif
                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script>
        function isStreamAvailable(source) {
            var http = new XMLHttpRequest();
            http.open('HEAD', source, false);
            http.send();
            let hasSource = http.status !== 404;
            console.log('is stream available: ' + hasSource);
            return hasSource;
        }

        function displaySeekingFrame() {
            $('#seeking-connection').removeClass('d-none');
            $('#connection-not-found').addClass('d-none');
            $('#connection-found').addClass('d-none');
        }

        function displayConnectionFoundFrame() {
            $('#seeking-connection').addClass('d-none');
            $('#connection-not-found').addClass('d-none');
            $('#connection-found').removeClass('d-none');
        }

        function displayConnectionNotFoundFrame() {
            $('#seeking-connection').addClass('d-none');
            $('#connection-not-found').removeClass('d-none');
            $('#connection-found').addClass('d-none');
        }

        function displayVideo() {
            $('#seeking-connection').addClass('d-none');
            $('#connection-not-found').addClass('d-none');
            $('#connection-found').addClass('d-none');
        }

        function startReconnectionCounter() {
            var reconnectionCounter = setInterval(function () {
                let counter = Number(document.getElementById('countdown').innerHTML);
                if (counter === 0) {
                    clearInterval(reconnectionCounter);
                    document.getElementById('countdown').innerHTML = '30';
                } else {
                    document.getElementById('countdown').innerHTML = counter - 1;
                }
            }, 1000);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const isFlashVideoSetting = {{$isFlashVideoSettingLiteral}};
            console.log("isFlashVideoSetting:" + isFlashVideoSetting);
            const source = "{{$videoSource}}";
            const flashSource = "{{$flashVideoSource}}";
            console.log(source);

            function doStuff() {
                let hasSource = isStreamAvailable(source);
                if (hasSource) {
                    displayConnectionFoundFrame();
                    setTimeout(function () {
                        console.log('waiting few seconds and initializing player');
                        initializePlayer(source, flashSource, isFlashVideoSetting);
                        displayVideo();
                    }, 5000); // wait 5 seconds
                } else {
                    displayConnectionNotFoundFrame();
                    startReconnectionCounter();
                }
                return hasSource;
            }


            let hasSource = isStreamAvailable(source);

            doStuff();
            if (!hasSource) {
                var checkExist = setInterval(function () {
                    let hasSource = doStuff();
                    if (hasSource) {
                        clearInterval(checkExist);
                    }
                }, 30000); // check every x seconds
            }
        });

        function initializePlayer(source, flashSource, isFlashVideoSetting) {
            console.log('waiting few seconds and initializing player');
            console.log('checking for video player');
            if (isFlashVideoSetting) {
                console.log('flash routine triggered');
                if (flvjs.isSupported()) {
                    console.log('flv.js is supported!!');
                    var player = videojs('my-flash-video', {techOrder: ['flash']});
                } else {
                    console.log('flv.js is not supported!!');
                }
            } else {
                console.log('html5 player routine triggered');
                console.log('searching for video element');
                let htmlVideoElement = document.querySelector('video');
                if (htmlVideoElement !== null) {

                    console.log('html video element exists');
                    // For more options see: https://github.com/sampotts/plyr/#options
                    // captions.update is required for captions to work with hls.js
                    const player = new Plyr(htmlVideoElement, {autoplay: false});
                    // player.on('ready', function(event) { player.start(); });
                    if (!Hls.isSupported()) {
                        console.log('not supported');
                        htmlVideoElement.src = source;
                    } else {
                        // For more Hls.js options, see https://github.com/dailymotion/hls.js
                        const hls = new Hls();
                        hls.on(Hls.Events.ERROR, function (event, data) {
                            console.log("error loading manifest");
                            console.log(event);
                            console.log(data);
                            console.log(data.type);
                            if (data.type == "networkError") {
                                console.log('network error!');
                            }
                        });
                        hls.loadSource(source);
                        hls.attachMedia(htmlVideoElement);

                        window.hls = hls;

                        // Handle changing captions
                        player.on('play', () => {

                            player.currentTime = player.duration - 5
                        });
                        player.on('stalled', () => {
                            console.log('stalled');
                            // Caption support is still flaky. See: https://github.com/sampotts/plyr/issues/994
                        });
                        player.on('error', () => {

                        });
                        player.on('waiting', () => {
                            console.log('waiting');
                        });
                        player.on('emptied', () => {
                            console.log('emptied');
                        });
                        player.on('loadedmetadata', () => {
                            console.log('loadedmetadata');
                        });
                    }
                    // Expose player so it can be used from the console
                    window.player = player;
                }
            }
            displayVideo();
        }

        function initializeFlashPlayer(flashSource) {
            console.log('searching for video element');
            let htmlVideoElement = document.querySelector('video');
            if (htmlVideoElement !== null) {

                console.log('html video element exists');
                // For more options see: https://github.com/sampotts/plyr/#options
                // captions.update is required for captions to work with hls.js
                const player = new Plyr(htmlVideoElement, {autoplay: false});
                // player.on('ready', function(event) { player.start(); });
                if (!Hls.isSupported()) {
                    console.log('not supported');
                    htmlVideoElement.src = source;
                } else {
                    // For more Hls.js options, see https://github.com/dailymotion/hls.js
                    const hls = new Hls();
                    hls.on(Hls.Events.ERROR, function (event, data) {
                        console.log("error loading manifest");
                        console.log(event);
                        console.log(data);
                        console.log(data.type);
                        if (data.type == "networkError") {
                            console.log('network error!');
                        }
                    });
                    hls.loadSource(source);
                    hls.attachMedia(htmlVideoElement);

                    window.hls = hls;

                    // Handle changing captions
                    player.on('play', () => {

                        player.currentTime = player.duration - 5
                    });
                    player.on('stalled', () => {
                        console.log('stalled');
                        // Caption support is still flaky. See: https://github.com/sampotts/plyr/issues/994
                    });
                    player.on('error', () => {
                        console.log('error');
                    });
                    player.on('waiting', () => {
                        console.log('waiting');
                    });
                    player.on('emptied', () => {
                        console.log('emptied');
                    });
                    player.on('loadedmetadata', () => {
                        console.log('loadedmetadata');
                    });
                }
                // Expose player so it can be used from the console
                window.player = player;
            }
        }
    </script>
@endsection
