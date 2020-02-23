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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::post('/user', function (Request $request) {
//    $content = json_decode($request->getContent());
//
//   return response([
//       "body"=>$content
//   ],200);
//});
Route::get('/user','Api\ValidationController@store')->name('userValid');
Route::post('/registration','Api\ValidationController@save')->name('registrationUser');
Route::post('/authorise','Api\AuthoriseController@auth')->name('authoriseUser');
