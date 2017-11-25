<?php

include('vendor/autoload.php');

include('TelegramBot.php');
include('Weather.php');

$telegramApi = new TelegramBot();

$weatherApi = new Weather();

while (true) {

	sleep(2);

	$updates = $telegramApi->getUpdates();

		foreach ($updates as $update)
		{

			if (isset($update->message->location))
			{
					$result = $weatherApi->getWeather($update->message->location->latitude, $update->message->location->longitude);

						switch ($result->weather[0]->main){

							case "CLear" :
									$response = "На улице безоблачно. Зонтик не нужен. Хорошего дня!";
									break;
							case "Clouds" :
									$response = "На улице облачно. Зонтик на всякий случай возьмите!";
									break;
							case "Rain" :
									$response = "На улице дождь. Возьмите зонтик!";
									break;
							default:
								$response = "посмотрите в окно и решите сами, пожайлуста!";
						}


					$telegramApi->sendMessage($update->message->chat->id, $response);

			} else {
				$telegramApi->sendMessage($update->message->chat->id, 'Отправь свою локацию');
			}
			}

	}