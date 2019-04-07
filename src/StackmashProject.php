<?php

namespace Stackmash;

use Stackmash\StackmashCurl;
use Stackmash\StackmashDevice;
use Stackmash\Errors\StackmashAPIException;
use Stackmash\Models\StackmashNotification;

class StackmashProject
{
	private $publicKey;

	private $privateKey;

	private $curl;

	private $device;

	private $config;

	public function __construct($publicKey, $privateKey, $config)
	{
		$this->curl = new StackmashCurl;
		$this->device = new StackmashDevice;
		$this->config = array_merge(require('config.php'), $config);

		$this->publicKey = $publicKey;
		$this->privateKey = $privateKey;
	}

	/**
	 * @param string $category Notification category slug
	 * @param string $title Title of the notification
	 * @param array $body Body of the notification
	 *
	 * @return StackmashNotification The notification object
	 */
	public function action($category, $title, $body = [])
	{
		$this->device->findDevice();

		$data = [
			"public_key" => $this->publicKey,
			"private_key" => $this->privateKey,
			"category" => $category,
			"title" => $title,
			"body" => json_encode($body)
		];

		if($this->config['showBrowser'])
			$data['browser'] = $this->device->getBrowser();

		if($this->config['showOs'])
			$data['os'] = $this->device->getOS();

		if($this->config['showIp'])
			$data['ip'] = $this->device->getIP();

		try
		{
			$response = $this->curl->post($data);
		} catch(Exception $e) {

		}

		if(!$response->hasErrors())
		{
			return new StackmashNotification($response->toObject());
		} else {
			try
			{
				$response->error();
			} catch(StackmashAPIException $e) {
				return $e->toObject();
			}
		}
	}
}