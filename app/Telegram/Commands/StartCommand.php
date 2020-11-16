<?php

namespace App\Telegram\Commands;

use Illuminate\Support\Facades\Cache;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class StartCommand extends SystemCommand
{
    protected $name = 'start';
    protected $usage = '/start';

    public function execute()
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $text = 'Hi! Welcome to Qberry Bot!';

        $data = [
            'chat_id' => $chat_id,
            'text' => $text,
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                    array(
                        array(
                            'text' => 'Get Characters',
                            'callback_data' => 'characters_page_1',
                        ),
                    )
                ),
            )),
        ];

        return Request::sendMessage($data);
    }
}
