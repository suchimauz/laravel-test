<?php


namespace App\Telegram;

use Doctrine\DBAL\Driver\PDOConnection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\DB as TelegramDB;

class Handler
{
    public function __construct() {
        try {
            $telegram = new Telegram('1466889510:AAFPDDwz9maeQMOkJsiK2C-1drAEFatzLoo', 'qberry_bot');
            $telegram->enableExternalMySql(DB::connection()->getPdo());
            $telegram->addCommandsPaths([
                base_path('app/Telegram/Commands'),
                base_path('app/Telegram/Commands/Keyboard'),
            ]);
            $telegram->handleGetUpdates($timeout = 60);

        } catch (TelegramException $e) {
            echo $e->getMessages();
        }
    }
}
