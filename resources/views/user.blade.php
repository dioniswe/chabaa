@extends('layouts.neutral')

@section('content')

    <div class="container">
    <br><br><br>
    <div class="row">
        <div class="position-ref flex-bottom ">
            {{__("messages.user_management")}}
        </div>
    </div>
    <div class="row">
        <a href="logout">
            {{__("logout")}}
        </a>
    </div>
    </div>
@endsection
