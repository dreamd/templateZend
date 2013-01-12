<?php

namespace Dream\Zend\Loader;

$zendLoaderFactory = 'library/Zend/Loader/AutoloaderFactory.php';
if (file_exists($zendLoaderFactory) === true) {
	include $zendLoaderFactory;
}
use Zend\Loader\AutoloaderFactory as ZendAutoloaderFactory;
class AutoloaderFactory extends ZendAutoloaderFactory {
}
?>