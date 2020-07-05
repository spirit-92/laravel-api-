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
Route::get('/user','Api\RegistrationController@store')->name('userValid');
Route::get('/GetUserValid','Api\AuthoriseController@authGet')->name('GetUserValid');
Route::post('/registration','Api\RegistrationController@save')->name('registrationUser');
Route::post('/authorise','Api\AuthoriseController@auth')->name('authoriseUser');
Route::get('/statisticUsers', 'Api\StatisticUserController@getUsers')->name('statisticUsers');
Route::get('/statisticUser', 'Api\StatisticUserController@getUser')->name('statisticUser');
Route::get('/infoUser', 'Api\UserInfoController@getUserInfo')->name('infoUser');
Route::get('/telegramBot',function (){
    $telegram = new Api('1291105227:AAEl_xYiTPeRJ3p_Tv6YyVfWXE23se29lT8'); //Устанавливаем токен, полученный у BotFather

    $result = $telegram -> getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя

    $text = $result["message"]["text"]; //Текст сообщения

    $chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя

    $name = $result["message"]["from"]["username"]; //Юзернейм пользователя

    $keyboard = [["Последние статьи"],["Картинка"],["Гифка"]]; //Клавиатура

    if($text){

        if ($text == "/start") {

            $reply = "Добро пожаловать в бота!";

            $reply_markup = $telegram->replyKeyboardMarkup([ 'keyboard' => $keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false ]);

            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply, 'reply_markup' => $reply_markup ]);

        }elseif ($text == "/help") {

            $reply = "Информация с помощью.";

            $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => $reply ]);

        }elseif ($text == "Картинка") {

            $url = "https://68.media.tumblr.com/6d830b4f2c455f9cb6cd4ebe5011d2b8/tumblr_oj49kevkUz1v4bb1no1_500.jpg";

            $telegram->sendPhoto([ 'chat_id' => $chat_id, 'photo' => $url, 'caption' => "Описание." ]);

        }elseif ($text == "Гифка") {

            $url = "https://68.media.tumblr.com/bd08f2aa85a6eb8b7a9f4b07c0807d71/tumblr_ofrc94sG1e1sjmm5ao1_400.gif";

            $telegram->sendDocument([ 'chat_id' => $chat_id, 'document' => $url, 'caption' => "Описание." ]);

        }elseif ($text == "Последние статьи") {

            $html=simplexml_load_file('http://netology.ru/blog/rss.xml');

            foreach ($html->channel->item as $item) {

                $reply .= "\xE2\x9E\xA1 ".$item->title." (<a href='".$item->link."'>читать</a>)\n";

            }

            $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode' => 'HTML', 'disable_web_page_preview' => true, 'text' => $reply ]);

        }else{

            $reply = "По запросу \"<b>".$text."</b>\" ничего не найдено.";

            $telegram->sendMessage([ 'chat_id' => $chat_id, 'parse_mode'=> 'HTML', 'text' => $reply ]);

        }

    }else{

        $telegram->sendMessage([ 'chat_id' => $chat_id, 'text' => "Отправьте текстовое сообщение." ]);

    }
});
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
