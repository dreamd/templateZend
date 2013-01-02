<?php
defined('__PROJECT__') === true || define('__PROJECT__', basename(dirname(__DIR__)));
chdir(dirname(dirname(dirname(__DIR__))));
require 'initAutoloader.php';

$applicationConfig = require 'project/'.__PROJECT__.'/config/application.php';
if (isset($applicationConfig['module_listener_options']) === true) {
	foreach ($applicationConfig['module_listener_options'] as $masterName => $masterValue) {
		foreach ($masterValue as $slaveName => $slaveValue) {
			$applicationConfig['module_listener_options'][$masterName][$slaveName] = getcwd().'/project/'.__PROJECT__.DIRECTORY_SEPARATOR.$slaveValue;
		}
	}
}
Zend\Mvc\Application::init($applicationConfig)->run();
