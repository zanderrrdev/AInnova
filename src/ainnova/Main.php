<?php

namespace ainnova;

use ainnova\utils\Logger;
use ainnova\utils\Client;
use ainnova\scheduler\RequestTask;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use Closure;

class Main extends PluginBase {

	private static ?Main $instance = null;
	private ?Client $api = null;

	/**
	 * Get Main class
	 *
	 * @return Main|null
	 */
	public static function getInstance(): ?Main {
		return self::$instance;
	}

	public function onEnable(): void {
		self::$instance = $this;

		$this->api = new Client();

		Logger::info('AInnova plugin loaded successfully');
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