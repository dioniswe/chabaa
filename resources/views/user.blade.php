@extends('layouts.neutral')

@section('content')

    <div class="container">
        <br><br>
        <div class="form-group">
            <div class="row">
                <div class="position-ref flex-bottom ">
                    {{__("messages.user_management")}}
                </div>
            </div>
            <br><br>
        </div>
        <form action="{{route('user-settings')}}" method="POST">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="card border-dark mb-6">
                <div class="card-body">
                    <div class="form-group">
                        <label for="form-name">{{__("messages.to_introduce_yourself")}}</label>
                        <input name="name" type="text" class="form-control" id="form-name" aria-describedby="nameHelp"
                               placeholder="{{__("username")}}" value="{{\Illuminate\Support\Facades\Session::get('name')}}">
                        <small id="nameHelp" class="form-text text-muted">
                        </small>
                    </div>
                </div>
            </div>
            <br>
            <div class="card border-dark">
                <div class="card-body">
                    <div class="form-group">

                        <label>{{__('messages.to_choose_streaming_type')}}</label>

                        <br><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="streamingVideoType" id="streamingType1"
                               @if(\Illuminate\Support\Facades\Session::get('streamingVideoType') == \App\Enum\StreamingType::STREAMING_TYPE_FLASH)
                                 checked="checked"
                               @endif
                               value="{{\App\Enum\StreamingType::STREAMING_TYPE_FLASH}}">
                            <label class="form-check-label" for="streamingType1">Flash</label>
                        </div>
                        <br><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="streamingVideoType" id="streamingType2"
                                   @if(\Illuminate\Support\Facades\Session::get('streamingVideoType') == \App\Enum\StreamingType::STREAMING_TYPE_HTML_5)
                                   checked="checked"
                                   @endif
                                   value="{{\App\Enum\StreamingType::STREAMING_TYPE_HTML_5}}">
                            <label class="form-check-label" for="streamingType2">Html 5</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-dark" style="border:0px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-9 col-9">
                            <div class="form-group pull-left">
                                <input type="submit" class="btn-outline-success btn" value="{{__("messages.apply_settings")}}">
                            </div>
                        </div>
                        <div class="col-sm-3 col-3">
                            <a class="btn-light btn float-right"
                               style="word-wrap: break-word; word-break: normal; white-space:normal !important; "
                               href="{{route('logout',__("routes.logout"))}}">
                                {{__("logout")}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
