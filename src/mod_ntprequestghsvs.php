<?php
defined('_JEXEC') or die;

if (version_compare(JVERSION, '4', 'lt'))
{
	JLoader::registerNamespace(
		'Joomla\Module\NtpRequestGhsvs\Administrator',
		__DIR__ . '/src',
		false,
		false,
		'psr4'
	);
}

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\NtpRequestGhsvs\Administrator\Helper\NtpRequestGhsvsHelper;

require_once __DIR__ . '/vendor/autoload.php';

$result = NtpRequestGhsvsHelper::getData($params);

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx', ''));
require ModuleHelper::getLayoutPath(
	'mod_ntprequestghsvs',
	$params->get('layout', 'default')
);
