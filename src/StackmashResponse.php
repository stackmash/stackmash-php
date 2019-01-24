<?php

namespace Stackmash;

use Stackmash\Errors\StackmashAPIException;

/**
 * Class Response
 *
 * @package Stackmash
 */
class StackmashResponse
{
	private $raw;

	private $responseCode;

	private $errorNumber;

	private $errorMessage;

	private $config;

	/**
	 * @return StackmashResponse Response instance
	 */
	public function __construct($ch)
	{
		$this->config = require('config.php');

		$this->execute($ch);
	}

	private function execute($ch)
	{
		$this->raw = curl_exec($ch);
		$this->errorNumber = curl_errno($ch);
		$this->errorMessage = curl_error($ch);
		$this->responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	}

	public function toObject()
	{
		return json_decode($this->raw);
	}

	public function toArray()
	{
		return json_decode($this->raw, true);
	}

	public function hasErrors()
	{
		if($this->raw === false)
		{
			return true;
		} else {
			if($this->responseCode != 200 && $this->responseCode != 201)
			{
				return true;
			}
		}

		return false;
	}

	public function error()
	{
		switch($this->responseCode)
		{
			case 401:
				throw new StackmashAPIException($this->raw, 401, 'Unauthorized');
				break;

			case 403:
				throw new StackmashAPIException($this->raw, 403, 'Forbidden');
				break;

			case 404:
				throw new StackmashAPIException($this->raw, 404, 'Not found');
				break;

			case 422:
				throw new StackmashAPIException($this->raw, 422, 'Unprocessable entity');
				break;

			case 500:
				throw new StackmashAPIException($this->raw, 500, 'Server error');
				break;
		}

		switch($this->errorNumber)
		{
			case CURLE_COULDNT_CONNECT:
			case CURLE_OPERATION_TIMEOUTED:
			case CURLE_COULDNT_RESOLVE_HOST:
				throw new StackmashAPIException('{"message":"Connection error: ' . $this->errorMessage . '"}');
				break;

			case CURLE_SSL_CACERT:
			case CURLE_SSL_PEER_CERTIFICATE:
				throw new StackmashAPIException('{"message":"SSL error: ' . $this->errorMessage . '"}');
				break;

			default:
				throw new StackmashAPIException('{"message":"Error, please contact support@stackmash.com: ' . $this->errorMessage . '"}');
		}
	}

	public function shouldRetry($tries)
	{
		if($tries >= $this->config['maxRetries'])
		{
			return false;
		}

		if($this->errorNumber === CURLE_OPERATION_TIMEOUTED)
		{
			return true;
		}

		if($this->errorNumber === CURLE_COULDNT_CONNECT)
		{
			return true;
		}

		if($this->responseCode === 409)
		{
			return true;
		}

		return false;
	}
}