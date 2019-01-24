<?php

namespace Stackmash;

use Stackmash\StackmashResponse;

/**
 * Class Curl
 *
 * @package Stackmash
 */
class StackmashCurl
{
	private $url = 'notification/create';

	private $config;

	/**
	 * @return StackmashCurl Curl instance
	 */
	public function __construct()
	{
		$this->config = require('config.php');
	}

	/**
	 * @param array $data The notification data
	 *
	 * @return StackmashResponse Output response
	 */
	public function post($data)
	{
		$opts = [];

		$opts[CURLOPT_URL] = $this->config['url'] . $this->url;
		$opts[CURLOPT_RETURNTRANSFER] = true;
		$opts[CURLOPT_POST] = true;
		$opts[CURLOPT_POSTFIELDS] = $data;
		$opts[CURLOPT_HTTPHEADER] = ['Accept: application/json'];

		return $this->execute($opts);
	}

	/**
	 * @param array $opts cURL options
	 *
	 * @return StackmashResponse Output response
	 */
	private function execute($opts)
	{
		$tries = 0;

		while(true)
		{
			$ch = $this->initCurl($opts);

			$response = new StackmashResponse($ch);

			curl_close($ch);

			if($response->shouldRetry($tries))
			{
				$tries = $tries + 1;
			} else {
				break;
			}
		}

		return $response;
	}

	/**
	 * @return obj cURL instance
	 */
	private function initCurl($opts)
	{
		$ch = curl_init();

		curl_setopt_array($ch, $opts);

		return $ch;
	}
}