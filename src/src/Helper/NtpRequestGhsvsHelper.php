<?php

namespace Joomla\Module\NtpRequestGhsvs\Administrator\Helper;

\defined('_JEXEC') or die;

use KrzysztofMazur\NTPClient\Impl\UdpNtpClient;
use KrzysztofMazur\NTPClient\Impl\CompositeNtpClient;

abstract class NtpRequestGhsvsHelper
{
	public static function getData($params)
	{
		$result = new \stdClass();
		$dateTimeZone = $params->get('dateTimeZone', 'Europe/Berlin');

		$clients = [
			new UdpNtpClient('pool.ntp.org', 123),
			new UdpNtpClient('ntp.pads.ufrj.br', 123)
		];
		$client = new CompositeNtpClient($clients);

		$result->unixTime = $client->getUnixTime();
		$result->utc = $client->getUnixTime();
		$result->zoneTime = $client->getTime(new \DateTimeZone($dateTimeZone));
		$result->dateTimeZone = $dateTimeZone;

		return $result;
	}
}
