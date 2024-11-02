<?php

namespace ainnova\scheduler;

use pocketmine\scheduler\AsyncTask;
use pocketmine\Server;
use Closure;
use ainnova\utils\Client;

class RequestTask extends AsyncTask {
	private string $message;
	private Client $api;
	private Closure $callback;
	private int $time;

	/**
	 * RequestTask constructor
	 *
	 * @param string $message
	 * @param Client $api
	 * @param Closure $callback
	 */
	public function __construct(string $message, Client $api, Closure $callback) {
		$this->message = $message;
		$this->api = $api;
		$this->callback = $callback;
		$this->time = time();
	}

	public function onRun(): void {
		$data = [
			'model' => $this->api->getModel(),
			'message' => $this->message
		];

		$ch = curl_init($this->api->getUrl());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, [
			'Content-Type: application/json',
			'Authorization: Bearer ' . $this->api->getToken()
		]);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		$result = curl_exec($ch);
		$error = curl_error($ch);
		curl_close($ch);

		if ($result === false) {
			$response = ['error' => 'Error: ' . $error];
		} else {
			$response = json_decode($result, true);
			if (json_last_error() !== JSON_ERROR_NONE) {
				$response = ['error' => 'Failed to decode JSON response'];
			}
		}
		$response['time'] = $this->time;

		if (isset($response['message']) && is_string($response['message'])) {
			$response['message'] = preg_replace('/[^\p{L}\p{N}\p{P}\s]/u', '', $response['message']);
		}

		$this->setResult($response);
	}

	/**
	 * Called when the task is completed
	 *
	 * @param Server $server
	 */
	public function onCompletion(Server $server): void {
		($this->callback)($server, $this->getResult());
	}
}
