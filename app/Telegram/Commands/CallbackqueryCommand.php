<?php

/**
 * This file is part of the PHP Telegram Bot example-bot package.
 * https://github.com/php-telegram-bot/example-bot/
 *
 * (c) PHP Telegram Bot Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Callback query command
 *
 * This command handles all callback queries sent via inline keyboard buttons.
 *
 * @see InlinekeyboardCommand.php
 */

namespace App\Telegram\Commands;

use App\Models\Character;
use Longman\TelegramBot\Commands\SystemCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Request;

class CallbackqueryCommand extends SystemCommand
{
    /**
     * @var string
     */
    protected $name = 'callbackquery';

    /**
     * @var string
     */
    protected $description = 'Handle the callback query';

    /**
     * @var string
     */
    protected $version = '1.2.0';

    /**
     * Main command execution
     *
     * @return ServerResponse
     * @throws \Exception
     */
    public function execute(): ServerResponse
    {
        // Callback query data can be fetched and handled accordingly.
        $callback_query = $this->getCallbackQuery();
        $callback_data = $callback_query->getData();

        $charactersData = preg_match('/characters_page_(\d)/', $callback_data, $characterMatches);
        $characterQuotes = preg_match('/character_quotes_(\d)/', $callback_data, $quoteMatches);


        if ($charactersData) {
            $charactersPage = (int)$characterMatches[1][0];
            $charactersCount = 3;
            $charactersOffset = $charactersCount * ($charactersPage - 1);
            foreach (Character::offset($charactersOffset)->limit($charactersCount)->get() as $character) {
                Request::sendMessage([
                    'chat_id' => $callback_query->getFrom()->getId(),
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

            $buttons = [];
            if ($charactersPage > 1) {
                $buttons[] = array(
                    'text' => 'Prev page',
                    'callback_data' => 'characters_page_' . ($charactersPage - 1),
                );
            }
            $buttons[] = array(
                'text' => 'Next page',
                'callback_data' => 'characters_page_' . ($charactersPage + 1),
            );
            Request::sendMessage([
                'chat_id' => $callback_query->getFrom()->getId(),
                'text' => 'You can view the list of quotes for character or get next or prev characters page',
                'reply_markup' => json_encode(array(
                    'inline_keyboard' => array(
                        $buttons,
                    ),
                )),
            ]);
        } else if ($characterQuotes) {
            $characterQuotesId = (int)$quoteMatches[1][0];
            $character = Character::find($characterQuotesId);
            $quotes = $character->quotes()->get();

            $text = '#' . $character->id . ' <b>' . $character->name . '</b> quotes:' . "\n";
            foreach ($quotes as $quote) {
                $text = $text . "\n" . '<b>#' . $quote->id . '</b>: ' . $quote->quote;
            }

            Request::sendMessage([
                'chat_id' => $callback_query->getFrom()->getId(),
                'parse_mode' => 'html',
                'text' => $text,
            ]);
        }

        return $callback_query->answer([
            'alert' => 0,
        ]);
    }
}
