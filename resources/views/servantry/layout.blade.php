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
        <a href="{{route('servantry-home')}}">{{__('home')}}</a>
        <a href="{{route('servantry-church')}}">{{__('church')}}</a>
        <a href="{{route('servantry-general')}}">{{__('general')}}</a>
        <a href="{{route('users')}}">{{__('user')}}</a>
        <a href="{{route('servantry-video-streaming')}}">{{__('video-streaming')}}</a>
        <a href="{{route('servantry-radio')}}">{{__('radio')}}</a>
        <a href="{{route('servantry-library')}}">{{__('library')}}</a>
        <a href="{{route('servantry-announcements')}}">{{__('announcements')}}</a>
        <a href="{{route('servantry-chat')}}">{{__('chat')}}</a>
        <a href="{{route('servantry-recordings')}}">{{__('recordings')}}</a>
    </div>

    <div class=" container content">
        @yield('content')
    </div>
</div>
</body>
</html>
<script>
    @yield('script')
</script>

