<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Our church') }}</title>
    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/neutral.css') }}" rel="stylesheet">

    @yield('head')
    <!-- Styles -->
</head>
<body>
<div class=" flex-center   full-height">
    <div class="links top-right">
        <a href="{{route('ministry-home')}}">{{__('home')}}</a>
        <a href="{{route('ministry-church')}}">{{__('church')}}</a>
        <a href="{{route('ministry-general')}}">{{__('general')}}</a>
        <a href="{{route('users')}}">{{__('user')}}</a>
        <a href="{{route('ministry-video-streaming')}}">{{__('video-streaming')}}</a>
        <a href="{{route('ministry-radio')}}">{{__('radio')}}</a>
        <a href="{{route('ministry-library')}}">{{__('library')}}</a>
        <a href="{{route('ministry-announcements')}}">{{__('announcements')}}</a>
        <a href="{{route('ministry-chat')}}">{{__('chat')}}</a>
        <a href="{{route('ministry-recordings')}}">{{__('recordings')}}</a>
    </div>

    <div class=" container content">
        @yield('content')
    </div>
</div>
</body>
</html>
<script>
    window.default_locale = "{{ config('app.locale') }}";
    window.fallback_locale = "{{ config('app.fallback_locale') }}";
</script>
<script src="https://unpkg.com/bootstrap-table@1.20.1/dist/bootstrap-table.min.js"></script>
<script src="{{ asset('vendor/font-awesome/js/all.js') }}"></script>
@yield('scripts')

