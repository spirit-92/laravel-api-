<?php


namespace App\Services;


use Telegram\Bot\Api;

class TelegramBotServices
{
    protected $telegram;
    protected $chat_id; //Уникальный идентификатор пользователя
    protected $name; //Юзернейм пользователя
    protected $keyboard = [["Не комерческие проекты"], ["Резюме"]];//Клавиатура
    protected $text;


    function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    function updateWebhook()
    {
        $result = $this->telegram->getWebhookUpdates(); //Передаем в переменную $result полную информацию о сообщении пользователя

        $this->text = $result["message"]["text"]; //Текст сообщения

        $this->chat_id = $result["message"]["chat"]["id"]; //Уникальный идентификатор пользователя

        $this->name = $result["message"]["from"]["username"]; //Юзернейм пользователя
    }

    function startTelegram()
    {
        $this->updateWebhook();
        $reply = "Добро пожаловать в бота!";
        if ($this->text) {
            switch ($this->text) {
                case "/start":
                    $reply_markup = $this->telegram->replyKeyboardMarkup(['keyboard' => $this->keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
                    $this->telegram->sendMessage(['chat_id' => $this->chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
                    break;
                case "/help":
                    $this->help();
                    break;
                case "Не комерческие проекты":
                    $this->aboutMe();
                    break;
                case 'Резюме':
                    $this->summary();
                    break;
                case 'Резюмер разработчика':
                    $this->telegram->sendDocument
                    (['chat_id' => $this->chat_id,
                        'document' => 'https://spirit.pp.ua/storage/uploads/summary/summary.pdf',
                        'caption' => "Резюме."
                    ]);
                    break;
                case 'Резюме стандарт':
                    $this->telegram->sendDocument
                    (['chat_id' => $this->chat_id,
                        'document' => 'https://spirit.pp.ua/storage/uploads/summary/summary2.pdf',
                        'caption' => "Резюме."
                    ]);
                    break;
                case 'назад':
                    $reply_markup = $this->telegram->replyKeyboardMarkup(['keyboard' => $this->keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
                    $this->telegram->sendMessage(['chat_id' => $this->chat_id, 'text' => $reply, 'reply_markup' => $reply_markup]);
                    break;
                default:
                    $reply = "По запросу \"<b>" . $this->text . "</b>\" ничего не найдено.";
                    $this->telegram->sendMessage(['chat_id' => $this->chat_id, 'parse_mode' => 'HTML', 'text' => $reply]);
            }
        } else {
            $this->telegram->sendMessage(['chat_id' => $this->chat_id, 'text' => "Отправьте текстовое сообщение."]);
        }
    }

    function summary()
    {
        $this->updateWebhook();
        $this->keyboard = [["Резюмер разработчика"], ["Резюме стандарт"], ['назад']];
        $reply_markup = $this->telegram->replyKeyboardMarkup(['keyboard' => $this->keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $this->telegram->sendMessage(
            ['chat_id' => $this->chat_id, 'text' => $this->text, 'reply_markup' => $reply_markup]
        );
    }

    function help()
    {
        $reply = "Информация с помощью тут должна быть ,но ты просто тыкай на кнопки и все";
        $this->telegram->sendMessage(['chat_id' => $this->chat_id, 'text' => $reply]);
    }

    function aboutMe()
    {
        $reply_markup = $this->telegram->replyKeyboardMarkup(['keyboard' => $this->keyboard, 'resize_keyboard' => true, 'one_time_keyboard' => false]);
        $text =  "<b>project: </b> <i>https://panasenko-angular-portfolio.herokuapp.com</i>\n<b>brainstorm: </b><i>https://spirit-brain.herokuapp.com</i>\n<b>brainstorm statistic: </b><i>https://spirit-brain.herokuapp.com/statistic</i>\n<b>sendPulse: </b><i>https://send-pulse.herokuapp.com</i>\n<b>loyalty: </b><i>https://spirit-92.github.io/landing-export</i>\n<b>monticello: </b><i>https://spirit-92.github.io/monticello_not-adapting-device</i>\n";
        $this->telegram->sendMessage(['chat_id' => $this->chat_id,'parse_mode' => 'HTML' ,'text' => $text, 'reply_markup' => $reply_markup]);
    }

}
