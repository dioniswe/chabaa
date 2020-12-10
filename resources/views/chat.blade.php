@extends('layouts.neutral-including-app-js')

@section('content')

    <div class="container">
        <div class="container">
            <form name="introduction" method="post" action="introduction">
                @csrf
                <div class="row">
                    <div style="display: table">
                        <div class="input-group" >
                            <input type="text" name="name" value="{{__("messages.introduction")}}"
                                   class="align-center form-control input-sm"
                                   placeholder="">
                        </div>
                        <div class="d-lg-table-cell"><input type="submit" value="{{__("messages.set")}}"
                                                            class="btn btn-primary btn-sm"></div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Chats</div>

                    <div class="panel-body">
                        <chat-messages v-on:messageinitialize="getMessages" :messages="messages"
                                       ref="messageFrame"></chat-messages>
                    </div>
                    <div class="panel-footer">
                        <chat-form
                            v-on:messagesent="addMessage"
                            :user="{{ Auth::user() }}"
                        ></chat-form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
@endsection
