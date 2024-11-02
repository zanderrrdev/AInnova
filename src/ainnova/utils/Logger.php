<?php

namespace ainnova\utils;

use pocketmine\Server;

class Logger {
	/**
	 * Log an informational message
	 *
	 * @param string $message
	 */
	public static function info(string $message): void {
		Server::getInstance()->getLogger()->info('§r§a[AInnova] §f' . $message);
	}

	/**
	 * Log an error message
	 *
	 * @param string $message
	 */
	public static function error(string $message): void {
		Server::getInstance()->getLogger()->error('§r§c[AInnova] §f' . $message);
	}
}
