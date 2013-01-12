<?php
defined('__PROJECT__') === true || define('__PROJECT__', basename(dirname(__DIR__)));
chdir(dirname(dirname(dirname(__DIR__))));

$autoLoaderPath = 'initAutoloader.php';
if (file_exists($autoLoaderPath) === false) {
	throw new RuntimeException('Have not auto loader.');
}
require $autoLoaderPath;

$paths = (object)array(
	'resources'					=> 'resources/',
	'local'							=> 'Local/',
);

$loadConfigs = array(
	'applicationConfig'		=> __PROJECT__.'/config/application.php',
	'databaseConfig'		=> __PROJECT__.'/config/database.php',
);

$applicationConfig = array();
$databaseConfig = array();

foreach ($loadConfigs as $name => $value) {
	if (file_exists($paths->resources.$paths->local.$value) === true) {
		$$name = require $paths->resources.$paths->local.$value;
		continue;
	}
	
	$$name = require $paths->resources.$value;
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
