<?php

namespace Stackmash;

use Stackmash\Project;

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
	 * @return Project Project object to send notifications to
	 */
	public static function getProject($publicKey, $privateKey, $config = [])
	{
		return new Project($publicKey, $privateKey, $config);
	}
}