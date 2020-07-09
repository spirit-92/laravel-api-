<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Telegram\Bot\Api;
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
//statistic User
Route::get('/statisticUsers', 'Api\StatisticUserController@getUsers')->name('statisticUsers');
Route::get('/statisticUser', 'Api\StatisticUserController@getUser')->name('statisticUser');
//telegram bot
Route::get('/telegram/setWebhook','Api\TelegramBot@setWebhook')->name('setTelegramWebhook');
Route::get('/telegram/deleteWebhook','Api\TelegramBot@deleteWebhook')->name('deleteTelegramWebhook');
Route::post('/telegram/update','Api\TelegramBot@update')->name('telegramUpdate');
//my project
Route::get('/user','Api\RegistrationController@store')->name('userValid');
Route::get('/GetUserValid','Api\AuthoriseController@authGet')->name('GetUserValid');
Route::post('/registration','Api\RegistrationController@save')->name('registrationUser');
Route::post('/authorise','Api\AuthoriseController@auth')->name('authoriseUser');


Route::middleware('auth_api')->group(function (){
    //auth
    Route::get('/getAllUser','Api\UserController@getAllUser')->name('getAllUser');
    Route::get('/userGet','Api\MusicController@getUser')->name('userGet');
    //news
    Route::delete('/deleteNews','Api\NewsController@deleteNews')->name('deleteNews');
    Route::post('/saveNews','Api\NewsController@saveNews')->name('saveNews');
    Route::get('/getNews','Api\NewsController@getNews')->name('getNews');

    //music
    Route::get('/allMusic','Api\MusicController@getAllMusic')->name('allMusic');
    Route::post('/saveMusic','Api\MusicController@saveMusic')->name('saveMusic');
    Route::post('/saveUserMusic','Api\MusicController@saveUserMusic')->name('saveUserMusic');
    Route::get('/getFavoriteMusic','Api\MusicController@getFavoriteMusic')->name('getFavoriteMusic');
    Route::delete('/deleteFavoriteMusic','Api\MusicController@deleteFavoriteMusic')->name('deleteFavoriteMusic');
    Route::delete('/deleteMusic','Api\MusicController@deleteMusic')->name('deleteMusic');

    //philosophy
    Route::post('/savePhilosophy','Api\PhilosophyController@savePhilosophy')->name('savePhilosophy');
    Route::get('/getPhilosophy','Api\PhilosophyController@getPhilosophy')->name('getPhilosophy');
    Route::put('/putPhilosophy','Api\PhilosophyController@putPhilosophy')->name('putPhilosophy');
    Route::post('/saveFavoritePhilosophy','Api\PhilosophyController@saveFavoritePhilosophy')->name('saveFavoritePhilosophy');
    Route::delete('/deletePhilosophy','Api\PhilosophyController@deletePhilosophy')->name('deletePhilosophy');
});
