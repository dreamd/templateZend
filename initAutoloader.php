<?php
include 'library/Zend/Loader/AutoloaderFactory.php';
$autoloaderSetting = require PROJECT_PATH.'/autoloader.php';
if (!class_exists('Zend\Loader\AutoloaderFactory')) {
    throw new RuntimeException('System Error');
} else {
	Zend\Loader\AutoloaderFactory::factory($autoloaderSetting);	
}
