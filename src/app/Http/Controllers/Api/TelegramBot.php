<?php

namespace App\Http\Controllers\Api;

use App\Services\TelegramBotServices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Telegram\Bot\Api;

class TelegramBot extends Controller
{
    function setWebhook(Api $telegram)
    {
        $telegram->removeWebhook();
        $telegram->setWebhook([
            'url' => 'https://spirit.pp.ua/telegram/update',
        ]);
    }
    function update(TelegramBotServices $botTelegramService){
        $botTelegramService->startTelegram();
    }
    function deleteWebhook(Api $telegram){
        $result =   $telegram->removeWebhook();
        echo $result->getDecodedBody()['description'];

    }

}
