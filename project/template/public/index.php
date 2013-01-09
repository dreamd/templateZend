<?php
defined('__PROJECT__') === true || define('__PROJECT__', basename(dirname(__DIR__)));
chdir(dirname(dirname(dirname(__DIR__))));
require 'initAutoloader.php';

$applicationConfig = require 'resources/'.__PROJECT__.'/config/application.php';
$databaseConfig = require 'resources/'.__PROJECT__.'/config/database.php';

if (isset($applicationConfig['databases']) === true && isset($databaseConfig['databases']) === true) {
	foreach ($applicationConfig['databases'] as $name => $value) {
		$applicationConfig['databases'][$name] = array_merge($value, $databaseConfig['databases'][$name]);
	}
}
Zend\Mvc\Application::init($applicationConfig)->run();
