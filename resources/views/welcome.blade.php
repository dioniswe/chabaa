<!DOCTYPE html>
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
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="links top-right">
            @auth

                <a href="{{ route('home', __('routes.home')) }}">{{__("enter")}}</a>
            @else
                <div class="row">
                    <div id="enter_internals" class="col-xs-6">
                        <a href="{{ route('login') }}">{{__("internals")}}</a>
                    </div>
                    <div id="request_contact" class="col-xs-6">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">{{__("contact")}}</a>
                        @endif
                    </div>
                </div>
            @endauth
        </div>
    @endif

    <div class="content" id="welcome" >
        <div class="title m-b-md">
            {{__("greeting_text_part_1")}}
        </div>
        <div class="title m-b-md">
            {{config('app.name_dative')}}
        </div>
        <br> <br>
        <div class="church-address m-b-md">
            {{\Illuminate\Support\Arr::get($config, 'management.church.street')}} <br>
           {{\Illuminate\Support\Arr::get($config, 'management.church.zip')}} {{\Illuminate\Support\Arr::get($config, 'management.church.city')}}<br>
            Telefon {{\Illuminate\Support\Arr::get($config, 'management.church.phone')}} <br>

            <img class="email-image" src="get-contact-email" class="responsive">
        </div>
    </div>
</div>
</body>
</html>

