<?php

namespace App\Telegram\Commands;

use App\Models\Character;
use Illuminate\Support\Facades\Cache;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Request;

class CharactersCommand extends SystemCommand
{
    protected $name = 'characters';
    protected $usage = '/characters';

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
                    ),
                ),
            )),
        ];

        foreach (Character::limit(3)->get() as $character) {
            Request::sendMessage([
                'chat_id' => $chat_id,
                'text' => '<b><i>#' . $character->id . '</i></b> Name: <b>' . $character->name . '</b>',
                'parse_mode' => 'html',
                'reply_markup' => json_encode(array(
                    'inline_keyboard' => array(
                        array(
                            array(
                                'text' => 'Get Quotes',
                                'callback_data' => 'character_quotes_' . $character->id,
                            ),
                        )),
                )),
            ]);
        }
        Request::sendMessage([
            'chat_id' => $chat_id,
            'text' => 'You can view the list of quotes for character or get next or prev characters page',
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                    array(
                        array(
                            'text' => 'Next page',
                            'callback_data' => 'characters_page_2',
                        ),
                    ),
                ),
            )),
        ]);
    }
}
