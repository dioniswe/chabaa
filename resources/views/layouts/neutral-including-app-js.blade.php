<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chabaa') }}</title>
    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/video.js/video-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/neutral.css?v=1') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!--script src="https://cdn.rawgit.com/video-dev/hls.js/18bb552/dist/hls.min.js"></script-->
    <!--script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script-->
    <script src="https://cdn.rawgit.com/video-dev/hls.js/18bb552/dist/hls.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.4/video.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/videojs-flash@2/dist/videojs-flash.min.js"></script>
    <script src="https://cdn.plyr.io/3.6.2/plyr.js"></script>

    <!-- MEDIA.JS >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.16/lang/de.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.16/mediaelement.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.16/mediaelement-and-player.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.16/mediaelementplayer.min.css"></script>

    JPLAYER -->


    @yield('head')
</head>
<body>
<div id="app">


    <div class="content container" id="app-navigation">
        <div class="links">
            <div class="row">
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{route('church_service',__('routes.church_service'))}}">
                        <div class="card">
                            <div class="card-image-top ">
                                <i class="fas fa-church fa-3x"></i>
                            </div>
                            <div class="card-body">
                                {{__('Live-Service')}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{route('radio',__('routes.radio'))}}">
                        <div class="card">
                            <div class="card-image-top ">
                                <i class="fas fa-broadcast-tower fa-3x"></i>
                            </div>
                            <div class="card-body">
                                {{__('Radio')}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{route('chat',__('routes.chat'))}}">
                        <div class="card">
                            <div class="card-image-top ">
                                <i class="fas fa-comments fa-3x"></i>
                            </div>
                            <div class="card-body">
                                {{__('Chat')}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{route('recordings',__('routes.recordings'))}}">
                        <div class="card">
                            <div class="card-image-top ">
                                <i class="fas fa-photo-video fa-3x"></i>
                            </div>
                            <div class="card-body">
                                {{__('Recordings')}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{route('user',__('routes.user'))}}">
                        <div class="card">
                            <div class="card-image-top ">
                                <i class="fas fa-user fa-3x"></i>
                            </div>
                            <div class="card-body">
                                {{__('user')}}
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                    <a href="{{route('announcements',__('routes.announcements'))}}">
                        <div class="card">
                            <div class="card-image-top ">
                                <i class="fas fa-calendar-alt fa-3x"></i>
                            </div>
                            <div class="card-body">
                                {{__('Calendar')}}/<br>{{__('Upcoming')}}
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @if (session('info'))
            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                {{ session('info') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    @yield('content')
</div>
</body>
</html>
<script>
    window.default_locale = "{{ config('app.locale') }}";
    window.fallback_locale = "{{ config('app.fallback_locale') }}";
    window.messages = @json($messages ?? '');
    window.setTimeout(function() {
        $(".alert.fade").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
    }, 2000);
</script>
<script src="{{ asset('js/app.js?v=1') }}"></script>
<script src="{{ asset('vendor/font-awesome/js/all.js') }}"></script>
@yield('scripts')
