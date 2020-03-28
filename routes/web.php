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

Auth::routes();

Route::get('/home', 'HomeController@index')
    ->name('home');
Route::get('/gottesdienst', 'HomeController@churchService')
    ->name('church-service');
Route::get('/radio', 'HomeController@radio')
    ->name('radio');
Route::get('/bücherei', 'HomeController@library')
    ->name('library');
Route::get('/abkündigungen', 'HomeController@announcements')
    ->name('announcements');
Route::get('/austausch', 'HomeController@chat')
    ->name('chat');
Route::get('/Vorstellung', 'HomeController@introduction')
    ->name('introduction');
Route::post('/introduction', 'HomeController@processIntroduction')
    ->name('process-introduction');
Route::get('/aufzeichnungen', 'HomeController@recordings')
    ->name('recordings');

Route::post('/messages', 'HomeController@messageReceived')
    ->name('messages');

Route::get('/get-messages', 'HomeController@getMessages')
    ->name('get-messages');

