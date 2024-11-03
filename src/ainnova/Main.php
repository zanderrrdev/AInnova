<?php

namespace ainnova;

use ainnova\utils\Logger;
use ainnova\utils\Client;
use ainnova\scheduler\RequestTask;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use Closure;

class Client
{
	private string $token;
	private string $model;
	private string $url;

	/**
	 * Get Main class
	 *
	 * @return Main|null
	 */
	public function __construct()
	{
		$this->token = 'your token';
		$this->model = 'ainnova model';
		$this->url = 'https://example/api/chat';
	}

	/**
	 * Set the API token
	 *
	 * @param string $token
	 */
	public function setToken(string $token): void {
		if ($this->api !== null) {
			$this->api->setToken($token);
		} else {
			Logger::error("API client not initialized");
		}
	}

	/**
	 * Set the AI model
	 *
	 * @param string $model
	 */
	public function setModel(string $model): void {
		if ($this->api !== null) {
			$this->api->setModel($model);
		} else {
			Logger::error("API client not initialized");
		}
	}

	/**
	 * Set the API URL
	 *
	 * @param string $url
	 */
	public function setApiUrl(string $url): void {
		if ($this->api !== null) {
			$this->api->setUrl($url);
			Logger::info("API URL set to {$url}");
		} else {
			Logger::error("API client not initialized");
		}
	}

	/**
	 * Send a message to the AI
	 *
	 * @param string $message
	 * @param Closure $callback
	 */
	public function sendMessage(string $message, Closure $callback): void {
		$this->getServer()->getScheduler()->scheduleAsyncTask(new RequestTask($message, $this->api, $callback));
	}
}

	/**
	 * Get the API URL for sending messages
	 *
	 * @return string
	 */
	public function getUrl(): string
	{
		return $this->url;
	}
}