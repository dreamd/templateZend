<?php
defined('__PROJECT__') === true || define('__PROJECT__', basename(dirname(__DIR__)));
chdir(dirname(dirname(dirname(__DIR__))));

$autoLoaderPath = 'initAutoloader.php';
if (file_exists($autoLoaderPath) === false) {
	throw new RuntimeException('Have not auto loader.');
}
require $autoLoaderPath;

$localPath = 'local/';

$loadConfigs = array(
	'applicationConfig'		=> 'resources/'.__PROJECT__.'/config/application.php',
	'databaseConfig'		=> 'resources/'.__PROJECT__.'/config/database.php',
);

$applicationConfig = array();
$databaseConfig = array();

foreach ($loadConfigs as $name => $value) {
	if (file_exists(($path = $localPath.$value)) === true) {
		$$name = require $path;
		continue;
	}
	if (file_exists($value) === true) {
		$$name = require $value;
	}
}

if (empty($applicationConfig) === true) {
	throw new RuntimeException('Have not project setting.');
}

if (isset($applicationConfig['databases']) === true && isset($databaseConfig['databases']) === true) {
	foreach ($applicationConfig['databases'] as $name => $value) {
		$applicationConfig['databases'][$name] = array_merge($value, $databaseConfig['databases'][$name]);
	}
}
Zend\Mvc\Application::init($applicationConfig)->run();
