<?php

namespace App\Http\Controllers;

use App\Model\Config;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if(Auth::id() !== User::ADMIN_USER_ID) {
            // TODO debug blocking
            return;
        }

        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('management.home');
    }

    /**
     * church characteristics stipulation
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function church(Request $request)
    {
        if($request->getMethod() === 'GET') {
            return view('management.church');
        }
        $request->all();
        dump($request->all());
        $config = Config::where('config','management.church.name')->first();
        if(empty($config)) {
            $config = new Config();
        }
        $config->config = 'management.church.name';
        $config->value = $request->get('name');
        $config->save();

        $config = Config::where('config','management.church.street')->first();
        if(empty($config)) {
            $config = new Config();
        }
        $config->config = 'management.church.street';
        $config->value = $request->get('street');
        $config->save();

        $config = Config::where('config','management.church.zip')->first();
        if(empty($config)) {
            $config = new Config();
        }
        $config->config = 'management.church.zip';
        $config->value = $request->get('zip');
        $config->save();

        $config = Config::where('config','management.church.city')->first();
        if(empty($config)) {
            $config = new Config();
        }

        $config->config = 'management.church.city';
        $config->value = $request->get('city');
        $config->save();

        return Redirect::to('management/church');
    }

    /**
     * general app configuration
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function general()
    {
        return view('management.general');
    }

    /**
     * church service lifestream configuration
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function videoStreaming()
    {
        return view('management.video-streaming');
    }

    /**
     * church user management
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function user()
    {
        return view('management.user');
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
        return view('management.radio');
    }

    /**
     * library
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function library()
    {
        return view('management.library');
    }

    /**
     * announcements
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function announcements()
    {

        return view('management.announcements');
    }

    /**
     * chat
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function chat(Request $request)
    {

        return view('management.chat');
    }

    /**
     * recordings
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recordings()
    {
        return view('management.recordings');
    }
}
