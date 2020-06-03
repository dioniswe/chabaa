<?php

namespace App\Http\Controllers;

use App\Events\MessageReceivedEvent;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    public function index()
    {
        return view('home');
    }

    /**
     * church service lifestream
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function churchService()
    {
        return view('church-service');
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
     * radio
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function radio()
    {
        return view('radio');
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
        return view('work-in-progress');
    }

    /**
     * chat
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Request $request)
    {
        $introducedName = $request->session()->get('introducedName');
        $hasIntroducedHimself = !empty($introducedName);
        if (!$hasIntroducedHimself) {
            return redirect(__('routes.introduction'));
        }
        $messages = Message::with('user')->get();
        return view('chat')->with('messages', $messages);
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
        $messages = Message::with('user')->get();
        Log::info($messages);
        return (string) $messages;
    }

}
