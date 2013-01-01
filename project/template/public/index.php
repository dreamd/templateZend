<?php
defined('PROJECT_PATH') === true || define('PROJECT_PATH', dirname(__DIR__));
chdir(dirname(dirname(dirname(__DIR__))));
require 'initAutoloader.php';

$applicationConfig = require PROJECT_PATH.'/config/application.php';
if (isset($applicationConfig['module_listener_options']) === true) {
	foreach ($applicationConfig['module_listener_options'] as $masterName => $masterValue) {
		foreach ($masterValue as $slaveName => $slaveValue) {
			$applicationConfig['module_listener_options'][$masterName][$slaveName] = PROJECT_PATH.DIRECTORY_SEPARATOR.$slaveValue;
		}
	}
}
Zend\Mvc\Application::init($applicationConfig)->run();
