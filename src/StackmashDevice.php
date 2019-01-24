<?php

namespace Stackmash;

class StackmashDevice
{
	private $browser = '';

	private $os = '';

	private $ip = '';

	private $preloaded = false;

	public function getBrowser()
	{
		return $this->browser;
	}

	public function getOS()
	{
		return $this->os;
	}

	public function getIP()
	{
		return $this->ip;
	}

	public function findDevice()
	{
		// We only need to find the device info once to improve speed
		if($this->preloaded)
		{
			return;
		}

		$this->browser = $this->findBrowser();
		$this->os = $this->findOS();
		$this->ip = $this->findIP();

		$this->preloaded = true;
	}

	private function findBrowser()
	{
		if(!isset($_SERVER['HTTP_USER_AGENT']))
			return 'Unknown';

		$agent = $_SERVER['HTTP_USER_AGENT'];
		$browser = "Unknown";

		$browser_array = [
			'/msie/i' => 'Internet Explorer',
			'/firefox/i' => 'Firefox',
			'/safari/i' => 'Safari',
			'/chrome/i' => 'Chrome',
			'/edge/i' => 'Edge',
			'/opera/i' => 'Opera',
			'/netscape/i' => 'Netscape',
			'/maxthon/i' => 'Maxthon',
			'/konqueror/i' => 'Konqueror',
			'/mobile/i'  => 'Handheld Browser'
		];

		foreach($browser_array as $regex => $value)
		{
			if(preg_match($regex, $agent))
			{
				$browser = $value;
			}
		}

		return $browser;
	}

	private function findOS()
	{
		if(!isset($_SERVER['HTTP_USER_AGENT']))
			return 'Unknown';

		$agent = $_SERVER['HTTP_USER_AGENT'];
		$os  = "Unknown";

		$os_array = [
			'/windows nt 10/i' => 'Windows 10',
			'/windows nt 6.3/i' => 'Windows 8.1',
			'/windows nt 6.2/i' => 'Windows 8',
			'/windows nt 6.1/i' => 'Windows 7',
			'/windows nt 6.0/i' => 'Windows Vista',
			'/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
			'/windows nt 5.1/i' => 'Windows XP',
			'/windows xp/i' => 'Windows XP',
			'/windows nt 5.0/i' => 'Windows 2000',
			'/windows me/i' => 'Windows ME',
			'/win98/i' => 'Windows 98',
			'/win95/i' => 'Windows 95',
			'/win16/i' => 'Windows 3.11',
			'/macintosh|mac os x/i' => 'Mac OS X',
			'/mac_powerpc/i' => 'Mac OS 9',
			'/linux/i' => 'Linux',
			'/ubuntu/i' => 'Ubuntu',
			'/iphone/i' => 'iPhone',
			'/ipod/i' => 'iPod',
			'/ipad/i' => 'iPad',
			'/android/i' => 'Android',
			'/blackberry/i' => 'BlackBerry',
			'/webos/i' => 'Mobile'
		];

		foreach($os_array as $regex => $value)
		{
			if(preg_match($regex, $agent))
			{
				$os = $value;
			}
		}

		return $os;
	}

	private function findIP()
	{
		if(!empty($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			if(!isset($_SERVER['REMOTE_ADDR']))
			{
				$ip = 'Unknown';
			} else {
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		}

		return $ip;
	}
}