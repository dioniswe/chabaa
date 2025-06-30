<?php

namespace App\Http\Controllers;

use App\Model\Config;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MinistryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        if(Auth::id() !== User::ADMIN_USER_ID) {
            // TODO debug blocking
            return;
        }
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('ministry.home');
    }

    /**
     * church characteristics stipulation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function church(Request $request)
    {
        if($request->getMethod() === 'GET') {
            return view('ministry.church');
        }
        $request->all();
        $config = Config::where('config','ministry.church.name')->first();
        if(empty($config)) {
            $config = new Config();
        }
        $config->config = 'ministry.church.name';
        $config->value = $request->get('name');
        $config->save();

        $config = Config::where('config','ministry.church.street')->first();
        if(empty($config)) {
            $config = new Config();
        }
        $config->config = 'ministry.church.street';
        $config->value = $request->get('street');
        $config->save();

        $config = Config::where('config','ministry.church.zip')->first();
        if(empty($config)) {
            $config = new Config();
        }
        $config->config = 'ministry.church.zip';
        $config->value = $request->get('zip');
        $config->save();

        $config = Config::where('config','ministry.church.city')->first();
        if(empty($config)) {
            $config = new Config();
        }

        $config->config = 'ministry.church.city';
        $config->value = $request->get('city');
        $config->save();

        $config = Config::where('config','ministry.church.email')->first();
        if(empty($config)) {
            $config = new Config();
        }

        $config->config = 'ministry.church.email';
        $config->value = $request->get('email');
        $config->save();


        $config = Config::where('config','ministry.church.phone')->first();
        if(empty($config)) {
            $config = new Config();
        }

        $config->config = 'ministry.church.phone';
        $config->value = $request->get('phone');
        $config->save();

        return Redirect::to('ministry/church');
    }

    /**
     * general app configuration
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function general()
    {
        return view('ministry.general');
    }

    /**
     * church service lifestream configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function videoStreaming()
    {
        return view('ministry.video-streaming');
    }

    /**
     * church user ministry
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        return view('ministry.user');
    }

    /**
     * church user ministry apply settings
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
        return view('ministry.radio');
    }

    /**
     * library
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function library()
    {
        return view('ministry.library');
    }

    /**
     * announcements
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function announcements()
    {

        return view('ministry.announcements');
    }
    /**
     * chat
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Request $request)
    {

        return view('ministry.chat');
    }

    /**
     * recordings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recordings()
    {
        return view('ministry.recordings');
    }
}
