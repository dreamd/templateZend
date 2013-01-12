<?php
$zendLoaderFactory = 'library/Dream/Zend/Loader/AutoloaderFactory.php';
if (file_exists($zendLoaderFactory) === true) {
	include $zendLoaderFactory;
}
if (!class_exists('Dream\Zend\Loader\AutoloaderFactory') || defined('__PROJECT__') === false) {
    throw new RuntimeException('System Error');
} else {
	include_once("library/Twig/Autoloader.php");
	Twig_Autoloader::register();
	$autoloaderSetting = array();
	$autoloaderSettingPath = __PROJECT__.'/config/autoloader.php';
	$paths = (object)array(
		'resources' => getcwd().'/resources/',
		'local' => 'Local/',
	);
	if (file_exists(($path = $paths->resources.$paths->local.$autoloaderSettingPath)) === true) {
		$autoloaderSetting = require $path;
	} else {
		$autoloaderSetting = require $paths->resources.$autoloaderSettingPath;	
	}
	if (empty($autoloaderSetting) === true) {
		throw new RuntimException('Have not autoloader setting');	
	}
	Dream\Zend\Loader\AutoloaderFactory::factory($autoloaderSetting);	
}
