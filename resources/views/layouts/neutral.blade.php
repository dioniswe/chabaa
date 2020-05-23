<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Chabaa') }}</title>

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/video.js/video-js.css') }}" rel="stylesheet">
    <link href="{{ asset('css/neutral.css') }}" rel="stylesheet">

    @yield('head')
</head>
<body>
<div id="app">

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="content container">
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
                                {{__('member')}}
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
    </div>

        @yield('content')
</div>
</body>
</html>
<script>
    window.default_locale = "{{ config('app.locale') }}";
    window.fallback_locale = "{{ config('app.fallback_locale') }}";
    window.messages = @json($messages);
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('vendor/font-awesome/js/all.js') }}"></script>
@yield('javascript')
