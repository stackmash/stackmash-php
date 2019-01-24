<?php

namespace Stackmash;

use Stackmash\StackmashProject;

/**
 * Class Stackmash
 *
 * @package Stackmash
 */
class Stackmash
{
	/**
	 * @param string $publicKey The project public key
	 * @param string $privateKey The project private key
	 *
	 * @return StackmashProject Project object to send notifications to
	 */
	public static function getProject($publicKey, $privateKey, $config = [])
	{
		return new StackmashProject($publicKey, $privateKey, $config);
	}
}