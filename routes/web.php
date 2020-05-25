<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

/*
 *  Set up locale and locale_prefix if other language is selected
 */
$altLanguages = \Illuminate\Support\Facades\Config::get('app.alt_langs');
if(is_null($altLanguages)){
    $altLanguages = [];
}
if (in_array(\Illuminate\Support\Facades\Request::segment(1), $altLanguages)) {

    \Illuminate\Support\Facades\App::setLocale(\Illuminate\Support\Facades\Request::segment(1));
    \Illuminate\Support\Facades\Config::set('app.locale_prefix', \Illuminate\Support\Facades\Request::segment(1));
}


/*
 * Set up route patterns - patterns will have to be the same as in translated route for current language
 */
foreach(\Illuminate\Support\Facades\Lang::get('routes') as $k => $v) {
    Route::pattern($k, $v);
}



Route::post('/introduction', 'HomeController@processIntroduction')
    ->name('process-introduction');

Route::post('/messages', 'HomeController@messageReceived')
    ->name('messages');

Route::get('/user-settings', 'HomeController@userSettings')
    ->name('user-settings');

Route::get('/get-messages', 'HomeController@getMessages')
    ->name('get-messages');

Route::group(array('prefix' => \Illuminate\Support\Facades\Config::get('app.locale_prefix')), function()
{
    Route::get('/{home}', 'HomeController@index')
        ->name('home');
    Route::get('/{church_service}','HomeController@churchService')
        ->name('church_service');
    Route::get('/{radio}', 'HomeController@radio')
        ->name('radio');
    Route::get('/{library}', 'HomeController@library')
        ->name('library');
    Route::get('/{announcements}', 'HomeController@announcements')
        ->name('announcements');
    Route::get('/{chat}', 'HomeController@chat')
        ->name('chat');
    Route::get('/{introduction}', 'HomeController@introduction')
        ->name('introduction');
    Route::get('/{recordings}', 'HomeController@recordings')
        ->name('recordings');
    Route::get('/{user}', 'HomeController@user')
        ->name('user');
    Route::get('/{logout}', 'HomeController@logout')
        ->name('logout');
});
