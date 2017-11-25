<?php

include('vendor/autoload.php');

include('TelegramBot.php');

$telegramApi = new TelegramBot();

$updates = $telegramApi->getUpdates();


foreach ($updates as $update)
{
		$telegramApi->sendMessage($update->message->chat->id, 'Привет');
}