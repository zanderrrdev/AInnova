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

		$options = [
			'http' => [
				'header' => 'Content-Type: application/json\r\n' .
					'Authorization: Bearer ' . $this->api->getToken() . '\r\n',
				'method' => 'POST',
				'content' => json_encode($data)
			]
		];

		$context = stream_context_create($options);
		$result = @file_get_contents($this->api->getUrl(), false, $context);

		$response = $result !== false ? json_decode($result, true) : ['error' => 'Failed to get response from API'];
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
