<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/user','Api\RegistrationController@store')->name('userValid');
Route::get('/GetUserValid','Api\AuthoriseController@authGet')->name('GetUserValid');
Route::post('/registration','Api\RegistrationController@save')->name('registrationUser');
Route::post('/authorise','Api\AuthoriseController@auth')->name('authoriseUser');

Route::middleware('auth_api')->group(function (){
    Route::get('/userGet','Api\MusicController@getUser')->name('userGet');
    Route::delete('/deleteNews','Api\NewsController@deleteNews')->name('deleteNews');
    Route::post('/saveNews','Api\NewsController@saveNews')->name('saveNews');
    Route::get('/getNews','Api\NewsController@getNews')->name('getNews');
    Route::get('/allMusic','Api\MusicController@getAllMusic')->name('allMusic');
    Route::post('/saveMusic','Api\MusicController@saveMusic')->name('saveMusic');
    Route::post('/saveUserMusic','Api\MusicController@saveUserMusic')->name('saveUserMusic');
    Route::get('/getFavoriteMusic','Api\MusicController@getFavoriteMusic')->name('getFavoriteMusic');
    Route::delete('/deleteFavoriteMusic','Api\MusicController@deleteFavoriteMusic')->name('deleteFavoriteMusic');
    Route::delete('/deleteMusic','Api\MusicController@deleteMusic')->name('deleteMusic');
});
