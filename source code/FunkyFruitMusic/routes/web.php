<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
    return view('index');
});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/new-release', 'FrontEndController@newrelease');
Route::get('/song/{id}', 'FrontEndController@songWithId');
Route::get('/category', 'FrontEndController@allCategory');
Route::get('/category/{categoryId}', 'FrontEndController@Category');
Route::get('/nation', 'FrontEndController@allNation');
Route::get('/nation/{nationId}', 'FrontEndController@Nation');
Route::get('/singer', 'FrontEndController@allSinger');
Route::get('/singer/{singerId}', 'FrontEndController@Singer');
Route::get('/musician', 'FrontEndController@allMusician');
Route::get('/musician/{musicianId}', 'FrontEndController@Musician');
Route::get('/artist', 'FrontEndController@Artist');
Route::get('/searchall', 'FrontEndController@searchAll');
Route::get('/searchall/{input}', 'FrontEndController@searchAllProcess');
Route::get('/searchsong/{input}', 'FrontEndController@searchSong');
Route::get('/searchalbum/{input}', 'FrontEndController@searchAlbum');
Route::get('/searchsinger/{input}', 'FrontEndController@searchSinger');
Route::get('/searchmusician/{input}', 'FrontEndController@searchMusician');
Route::get('/test', 'FrontEndController@dashboardReport');
Route::get('/likedSongs/{songId}', 'FrontEndController@likedSongs');
Route::get('/album', 'FrontEndController@allAlbum');
Route::get('/album/{albumId}', 'FrontEndController@Album');
Route::get('/recent', 'FrontEndController@recent');
Route::get('/lsongs', 'FrontEndController@lsongs');
Route::get('/aboutus', 'FrontEndController@aboutus');
Route::get('/delete', 'DeleteController@delete');
Route::get('/songReport', 'FrontEndController@songReport');
Route::get('/removelsongs/{songId}', 'FrontEndController@removelsongs');
Route::get('/comment', 'FrontEndController@comment');
