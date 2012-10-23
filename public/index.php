<?php

function exception_handler($exception) {
  echo "Uncaught exception: " , $exception->getMessage(), "\n";
}

set_exception_handler('exception_handler');
	define("ViewFolder", __DIR__.DIRECTORY_SEPARATOR."Views".DIRECTORY_SEPARATOR);
	require_once("Common.php");
	chdir(dirname(__DIR__));
	include_once("Twig/Autoloader.php");
	Twig_Autoloader::register();
	
	include_once'Zend/Loader/AutoloaderFactory.php';
	Zend\Loader\AutoloaderFactory::factory(array(
		'Zend\Loader\StandardAutoloader' => array(
			'autoregister_zf' => true,
			"namespaces" => array(
				"Dream" => "Dream",
				"Twig" => "Twig",
				"phpbrowscap" => "PhpBrowscap"			  
			),
		),
	));
	
	$application = include_once 'ZendConfig/ApplicationConfig.php';
	for ($i = 0; $i < count($application["module_listener_options"]["config_glob_paths"]); $i++) {
		$application["module_listener_options"]["config_glob_paths"][$i] = basename(dirname(__FILE__)).DIRECTORY_SEPARATOR.$application["module_listener_options"]["config_glob_paths"][$i];
	}
	for ($i = 0; $i < count($application["module_listener_options"]["module_paths"]); $i++) {
		$application["module_listener_options"]["module_paths"][$i] = basename(dirname(__FILE__)).DIRECTORY_SEPARATOR.$application["module_listener_options"]["module_paths"][$i];
	}
	
	Zend\Mvc\Application::init($application)->run();
?>