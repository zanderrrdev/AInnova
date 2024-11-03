<?php

namespace ainnova\utils;

class Client {
	private string $token;
	private string $model;
	private string $url;

	/**
	 * Client constructor
	 */
	public function __construct() {
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
		$this->token = $token;
	}

	/**
	 * Set the AI model
	 *
	 * @param string $model
	 */
	public function setModel(string $model): void {
		$this->model = $model;
	}

	/**
	 * Set the API URL
	 *
	 * @param string $url
	 */
	public function setUrl(string $url): void {
		$this->url = $url;
	}

	/**
	 * Get the API token
	 *
	 * @return string
	 */
	public function getToken(): string {
		return $this->token;
	}

	/**
	 * Get the AI model
	 *
	 * @return string
	 */
	public function getModel(): string {
		return $this->model;
	}

	/**
	 * Get the API URL for sending messages
	 *
	 * @return string
	 */
	public function getUrl(): string {
		return $this->url;
	}
}