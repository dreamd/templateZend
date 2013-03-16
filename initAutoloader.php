<?php
$zendLoaderFactory = 'library/Dream/Zend/Loader/AutoloaderFactory.php';
if (file_exists(($path = $localPath.$zendLoaderFactory)) === true) {
	include $path;
} else if (file_exists($zendLoaderFactory) === true) {
	include $zendLoaderFactory;
}
if (!class_exists('Dream\Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('System Error');
} else {
	include_once("library/Twig/Autoloader.php");
	Twig_Autoloader::register();
	$autoloaderSetting = array();
	$autoloaderSettingPath = 'resources/'.$project.'/config/autoloader.php';
	
	if (file_exists(($path = $localPath.$autoloaderSettingPath)) === true) {
		$autoloaderSetting = require $path;
	} else {
		if (file_exists($autoloaderSettingPath) === true) {
			$autoloaderSetting = require $autoloaderSettingPath;
		}
	}
	if (empty($autoloaderSetting) === true) {
		throw new RuntimeException('Have not autoloader setting');	
	}
	Dream\Zend\Loader\AutoloaderFactory::factory($autoloaderSetting);	
}
