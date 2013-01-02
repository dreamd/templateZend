<?php
$zendLoaderFactory = 'library/Zend/Loader/AutoloaderFactory.php';
if (file_exists($zendLoaderFactory) === true) {
	include $zendLoaderFactory;
}
if (!class_exists('Zend\Loader\AutoloaderFactory') || defined('__PROJECT__') === false) {
    throw new RuntimeException('System Error');
} else {
	include_once("library/Twig/Autoloader.php");
	Twig_Autoloader::register();
	$autoloaderSetting = require getcwd().'/project/'.__PROJECT__.'/config/autoloader.php';
	Zend\Loader\AutoloaderFactory::factory($autoloaderSetting);	
}
