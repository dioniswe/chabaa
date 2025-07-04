<?php

namespace App\Http\Controllers;

use App\Enum\ChatChannels;
use App\Enum\StreamingType;
use App\Events\MessageReceivedEvent;
use App\Model\AppointedDates;
use App\Model\Message;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    /**
     * church service lifestream
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function churchService(Request $request)
    {
        $isFlashVideoSetting = \session('streamingVideoType') == StreamingType::STREAMING_TYPE_FLASH;
        //dd($isFlashVideoSetting);
        $streamingServerPort = Config::get('app.streaming_server_port');
        $streamingServerPort = 8080;
        $streamingServerHtml5StreamingKey = Config::get('app.streaming_server_html5_streaming_key');

        //$videoSource =  $request->getScheme() . '://' . 'streaming-outbound.' . $request->getHttpHost().'/live/'.$streamingServerHtml5StreamingKey.'/index.m3u8';
        $flashVideoSource = 'rtmp://' .request()->getHost().'/hls/'.$streamingServerHtml5StreamingKey;

            $flashVideoSource = url(request()->getSchemeAndHttpHost()).':'.$streamingServerPort.'/hls/'.$streamingServerHtml5StreamingKey.'.m3u8';

        //$flashVideoSource = $request->getScheme() . '://' . 'streaming-outbound.' . $request->getHttpHost().'/live/'.$streamingServerHtml5StreamingKey.'.flv';

        //dd($videoSource);
        return response()
            ->view('church-service', [
            'isFlashVideoSetting'=> $isFlashVideoSetting
            ,'isFlashVideoSettingLiteral'=> $isFlashVideoSetting ? 'true' : 'false'
            //,'videoSource'=> $videoSource
            ,'videoSource'=> $flashVideoSource,
            'flashVideoSource'=> $flashVideoSource
        ],200)
            ->header('Access-Control-Allow-Origin', '*');
    }

    /**
     * church user management
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        return view('user');
    }

    /**
     * church user management apply settings
     */
    public function userSettings(Request $request)
    {
        $name = $request->get('name');
        $streamingVideoType = $request->get('streamingVideoType');
        $request->session()->put('name', $name);
        $request->session()->put('streamingVideoType', $streamingVideoType);

        $request->session()->flash('info', 'die Einstellungen wurden übernommen');
        ;
        return redirect()->to(route('user',__('routes.user')));
    }

    /**
     * radio
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function radio()
    {
        $streamingServerPort = Config::get('app.streaming_server_port');
        $audioSource = url(request()->getSchemeAndHttpHost() . ':8080/' . config('chabaa.ICECAST_MOUNT_NAME'));
        return view('radio')
            ->with('audioSource', $audioSource);
    }

    /**
     * library
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function library()
    {
        return view('work-in-progress');
    }

    /**
     * announcements
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function announcements()
    {

        return view('announcements-management')->with('appointedDates', AppointedDates::all());
    }

    /**
     * chat
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Request $request)
    {
        $introducedName = $request->session()->get('name');
        $hasIntroducedHimself = !empty($introducedName);
        $messages = Message::recentMessages()->get();
        $channels = ChatChannels::getChatChannels();
        return view('chat')
            ->with('messages', $messages)
            ->with('hasIntroducedHimself', $hasIntroducedHimself)
            ->with('channels', $channels);
    }

    /**
     * logout
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * introduction
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function introduction(Request $request)
    {
        return view('introduction');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function processIntroduction(Request $request)
    {
        $name =$request->get('name');
        $request->session()->put('introducedName', $name);
        return redirect('austausch');

    }

    /**
     * recordings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recordings()
    {

        if(Auth::id() == User::CONGREGATION_USER_ID) {
            $files = Storage::disk('sftp')->files();
            return view('recordings-readonly')->with('files', $files);
        }
        return view('recordings');
    }

    /**
     * message received
     */
    public function messageReceived(Request $request)
    {
        $message = new Message();
        $messageContent = request('message');
        $message->message = $messageContent;
        $message->user_id = Auth::id();
        $message->save();
        Log::info('received message, broadcasting now !');
        broadcast(new MessageReceivedEvent($request->all()));
    }

    /**
     * message received
     */
    public function getMessages(Request $request)
    {
        Log::info('received get all messages request');
        $messages = Message::recentMessages()->get();
        Log::info($messages);
        return (string) $messages;
    }


}
