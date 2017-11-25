<?php

use GuzzleHttp\Client;

class TelegramBot
{

		protected $token = "357535455:AAHzK4iZFKl_2U0C4yQqC3svZI7vBXQdSpI";

		protected function query($method, $params = [])
		{
			$url = "https://api.telegram.org/bot";
			$url .= $this->token;
			$url .= "/" . $method;

			if (!empty($params)) {
				$url .= "?" . http_build_query($params);
			}

			$client = new Client([
			'base_uri' => $url
			]);	

			$result = $client->request('GET');
			return json_decode($result->getBody());
		}

		public function getUpdates()
		{

			$response = $this->query('getUpdates');

			return $response->result;
		}

		public function sendMessage($chat_id, $text)
		{
			
				$response = $this->query('sendMessage', [
						'text' => $text,
						'chat_id' => $chat_id
				]);

				return $response;
		}
}