<?php
$zendLoaderFactory = 'library/Dream/Zend/Loader/AutoloaderFactory.php';
$localPath = 'Local/';
if (file_exists(($path = $localPath.$zendLoaderFactory)) === true) {
	include $path;
} else if (file_exists($zendLoaderFactory) === true) {
	include $zendLoaderFactory;
}
if (!class_exists('Dream\Zend\Loader\AutoloaderFactory') || defined('__PROJECT__') === false) {
    throw new RuntimeException('System Error');
} else {
	include_once("library/Twig/Autoloader.php");
	Twig_Autoloader::register();
	$autoloaderSetting = array();
	$autoloaderSettingPath = 'resources/'.__PROJECT__.'/config/autoloader.php';
	
	if (file_exists(($path = $localPath.$autoloaderSettingPath)) === true) {
		$autoloaderSetting = require $path;
	} else {
		if (file_exists($autoloaderSettingPath) === true) {
			$autoloaderSetting = require $autoloaderSettingPath;
		}
	}
	if (empty($autoloaderSetting) === true) {
		throw new RuntimException('Have not autoloader setting');	
	}
	Dream\Zend\Loader\AutoloaderFactory::factory($autoloaderSetting);	
}
