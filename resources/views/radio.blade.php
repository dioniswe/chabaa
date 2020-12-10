@extends('layouts.neutral-including-app-js')

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
                                <div style="text-align:center; font-size: 18px" size="20"> Aktuell gibt es (noch)
                                    keine
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
                <div class="col-lg-8 ">
                    <div class="row">
                        <div class="flex-center d-none" id="radio-player">
                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div id="jp_container_1" class="card mb-8 jp-audio" role="application"
                                 aria-label="media player">
                                <div class="card-body p-2">
                                    <div class="row no-gutters">
                                        <div class="col-auto align-self-center text-center">
                                            <button class="btn btn-primary btn-sm  ml-1 mr-2 jp-play">
                                                <i class="fa fa-play fa-fw"></i>
                                            </button>
                                            <button class="btn btn-primary btn-sm  ml-1 mr-2 jp-pause">
                                                <i class="fa fa-pause fa-fw"></i>
                                            </button>
                                        </div>
                                        <div class="col-auto align-self-center text-center">
                                            <small class="jp-current-time">00:00</small>
                                        </div>
                                        <div class="col px-2 align-self-center">
                                            <div class="progress bg-light jp-progress">
                                                <div
                                                    class="progress-bar progress-bar-striped progress-bar-animated jp-play-bar"
                                                    role="progressbar" style="width: 100%" aria-valuenow="100"
                                                    aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="col-auto align-self-center text-center">
                                            <small class="jp-duration">00:00</small>
                                        </div>
                                        <div class="col-auto ml-2 align-self-center text-center">
                                            <a href="#" class="btn btn-primary btn-sm bs-volume"
                                               data-toggle="popover"
                                               data-container="" data-placement="top" data-html="true"
                                               data-content="">
                                                <i class="fa fa-volume-up fa-fw"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script type="text/javascript" src="/js/jplayer/dist/jplayer/jquery.jplayer.js"></script>
    <script type="text/javascript" src="/js/jstrapplayer.js"></script>
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

        function displayRadio() {
            $('#seeking-connection').addClass('d-none');
            $('#connection-not-found').addClass('d-none');
            $('#connection-found').addClass('d-none');
            $('#radio-player').removeClass('d-none');
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
            const source = "{{$audioSource}}";
            console.log(source);

            function doStuff() {
                let hasSource = isStreamAvailable(source);
                if (hasSource) {
                    displayConnectionFoundFrame();
                    setTimeout(function () {
                        console.log('waiting few seconds and initializing player');
                        initializePlayer(source);
                        displayRadio();
                    }, 1000); // wait 5 seconds
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


        function initializePlayer(source) {
            console.log('waiting few seconds and initializing player');

            console.log('searching for video element');
            let htmlAudioElement = $('#jquery_jplayer_1');
            console.log(htmlAudioElement);
            if (htmlAudioElement !== null) {

                htmlAudioElement.jStrapPlayer({
                    cssSelectorAncestor: '#jp_container_1',
                    swfPath: 'jplayer',
                    supplied: 'oga',
                    wmode: 'window',
                    autoBlur: false,
                    smoothPlayBar: false,
                    keyEnabled: true,
                    remainingDuration: false,
                    toggleDuration: true,
                    media: {
                        title: "Predigt",
                        oga: source
                    }
                });

            }
        }
    </script>

@endsection
