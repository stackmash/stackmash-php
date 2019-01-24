<?php

namespace Stackmash\Errors;

use Exception;

class StackmashAPIException extends Exception
{
	private $httpCode;

	private $httpError;

	public function __construct($message, $httpCode = null, $httpError = null)
	{
		$this->httpCode = $httpCode;

		$this->httpError = $httpError;

		parent::__construct($message);
	}
	public function __toString()
	{
		return $this->message;
	}

	public function toObject()
	{
		$error = json_decode($this->message, true);
		$error['error'] = $this->httpError;
		$error['code'] = $this->httpCode;

		return $error;
	}
}