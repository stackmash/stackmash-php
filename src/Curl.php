<?php

namespace Stackmash;

use Stackmash\Response;

/**
 * Class Curl
 *
 * @package Stackmash
 */
class Curl
{
	private $url = 'notification/create';

	private $config;

	/**
	 * @return Curl Curl instance
	 */
	public function __construct()
	{
		$this->config = require('config.php');
	}

	/**
	 * @param array $data The notification data
	 *
	 * @return Response Output response
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
	 * @return Response Output response
	 */
	private function execute($opts)
	{
		$tries = 0;

		while(true)
		{
			$ch = $this->initCurl($opts);

			$response = new Response($ch);

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