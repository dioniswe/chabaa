@extends('layouts.neutral')


@section('head')

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="chat-container">
                    <div class="col-sm-12 message_section">
                        <div class="row">
                            <div class="new_message_head">
                                Gebetesanliegen, Grüße, Mitteilungen
                            </div>
                            <chat-messages v-on:messageinitialize="getMessages" :messages="messages" ref="messageFrame"></chat-messages>
                            <chat-form
                                    v-on:messagesent="addMessage"
                                    :user="{{ Auth::user() }}"
                            ></chat-form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 flex-center">
                <video
                        id="my-video"
                        class="video-js"
                        controls
                        preload="auto"
                        width="800"
                        height="450"
                        data-setup='{}'
                >
                    <source src="{{url(request()->getSchemeAndHttpHost() . ':8000/' )}}live/stream_name/index.m3u8"
                            type="application/x-mpegURL"/>
                    <p class="vjs-no-js">
                        Bitte warten, bis die Übertragung startet. Technische Vorraussetzungen sind JavaScript, und
                        ein
                        Browser,
                        welcher Html5 Videos unterstützt:
                        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                    </p>
                </video>
            </div>
        </div>
    </div>
@endsection