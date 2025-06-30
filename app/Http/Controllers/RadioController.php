<?php

namespace App\Http\Controllers;

use App\Enum\ChatChannels;
use App\Enum\StreamingType;
use App\Events\MessageReceivedEvent;
use App\Model\Appointment;
use App\Model\Message;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class RadioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * radio
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function radio(Request $request)
    {
        $streamingServerPort = Config::get('app.streaming_server_port');
        //$videoSource =  $request->getScheme() . '://' . 'streaming-outbound.' . $request->getHttpHost().'/live/'.$streamingServerHtml5StreamingKey.'/index.m3u8';
        //$audioSource = $request->getScheme() . '://' . 'icecast.' . $request->getHttpHost() . ':8080/' . config('chabaa.ICECAST_MOUNT_NAME');
        $audioSource = url(request()->getSchemeAndHttpHost() . ':'. config('chabaa.ICECAST_PORT').'/' . config('chabaa.ICECAST_MOUNT_NAME'));
        return view('radio')
            ->with('audioSource', $audioSource);
    }

}
