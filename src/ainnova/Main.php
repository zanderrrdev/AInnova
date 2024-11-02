<?php

namespace ainnova;

use pocketmine\plugin\PluginBase;
use pocketmine\Server;

class Main extends PluginBase {

	private static ?Main $instance = null;

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
	}
}
