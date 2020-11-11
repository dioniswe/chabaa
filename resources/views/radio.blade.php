@extends('layouts.neutral')


@section('content')
    <!--div class="container" id="church-service" data-channel-prefix="{{config("database.redis.options.prefix")}}">
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
            </div-->
<div>
        <div class="col-lg-8 flex-center">
            <iframe src="{{url(request()->getSchemeAndHttpHost() . ':8008/' . config('chabaa.ICECAST_MOUNT_NAME'))}}"
                    id="iframeAudio"></iframe>
        </div>
    </div>
@endsection

@section('javascript')

    <script>
        /* TODO direct embedding through <audio> does not work everywhere ( in chrome? ) Make sure the correct alternative is chosen
        document.ready(function() {
            var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
            if (!isChrome) {
                $('#iframeAudio').remove()
            } else {
                $('#playAudio').remove() // just to make sure that it will not have 2x audio in the background
            }
        });
    */
    </script>

@endsection
