<?php

namespace ainnova;

use ainnova\utils\Logger;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;

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
		Logger::info('AInnova plugin loaded successfully');
	}

	/**
	 * Set the API token
	 *
	 * @param string $token
	 */
	public function setToken(string $token): void {
		$this->api->setToken($token);
	}

	/**
	 * Set the AI model
	 *
	 * @param string $model
	 */
	public function setModel(string $model): void {
		$this->api->setModel($model);
	}

	/**
	 * Send a message to the AI
	 *
	 * @param string $message
	 * @param Closure $callback
	 */
	public function sendMessage(string $message, Closure $callback): void {
		$this->getScheduler()->scheduleAsyncTask(new RequestTask($message, $this->api, $callback));
	}
}
