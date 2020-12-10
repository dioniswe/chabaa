<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Our church') }}</title>
    <!-- Fonts -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/font-awesome/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/neutral.css') }}" rel="stylesheet">
    <!-- Styles -->
</head>
<body>
<div class=" flex-center   full-height">
    <div class="links top-right">
        <a href="{{route('management-home')}}">{{__('home')}}</a>
        <a href="{{route('management-church')}}">{{__('church')}}</a>
        <a href="{{route('management-general')}}">{{__('general')}}</a>
        <a href="{{route('management-user')}}">{{__('user')}}</a>
        <a href="{{route('management-video-streaming')}}">{{__('video-streaming')}}</a>
        <a href="{{route('management-radio')}}">{{__('radio')}}</a>
        <a href="{{route('management-library')}}">{{__('library')}}</a>
        <a href="{{route('management-announcements')}}">{{__('announcements')}}</a>
        <a href="{{route('management-chat')}}">{{__('chat')}}</a>
        <a href="{{route('management-recordings')}}">{{__('recordings')}}</a>
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

