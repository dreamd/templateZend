<?php
$project = basename(dirname(__DIR__));
chdir(dirname(dirname(dirname(__DIR__))));

$autoLoaderPath = 'initAutoloader.php';
$localPath = 'Local/';

if (file_exists($autoLoaderPath) === false) {
	throw new RuntimeException('Have not auto loader.');
}
require $autoLoaderPath;

$configData = array(
	'application' => array(
		'path' => 'resources/'.$project.'/config/application.php',
		'config' => array()
	),
	'database' => array(
		'path' => 'resources/'.$project.'/config/database.php',
		'config' => array()
	),
);
foreach ($configData as $name => $value) {
	if (file_exists(($path = $localPath.$value['path'])) === true) {
		$configData[$name]['config'] = require $path;
		continue;
	}
	if (file_exists(($path = $value['path'])) === true) {
		$configData[$name]['config'] = require $path;
	}
}

if (empty($configData['application']['config']) === true) {
	throw new RuntimeException('Have not project setting.');
}

if (isset($configData['application']['config']['databases']) === true && isset($configData['database']['config']['databases']) === true) {
	foreach ($configData['application']['config']['databases'] as $name => $value) {
		if (isset($configData['database']['config']['databases'][$name]) === true) {
			$configData['application']['config']['databases'][$name] = array_merge($value, $configData['database']['config']['databases'][$name]);
		}
	}
}
Dream\Application\Application::init($configData['application']['config']);
