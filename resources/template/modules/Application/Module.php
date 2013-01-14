<?php

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {
    public function onBootstrap(MvcEvent $e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    public function getConfig() {
		$moduleConfig = '/resources/'.__PROJECT__.'/modules/'.__NAMESPACE__.'/config/module.php';
		$localPath = 'local/';
		$config = array();
		if (file_exists($path = $localPath.$moduleConfig) === true) {
			$nowModule = __NAMESPACE__;
			$config = include $path;
		} else if (file_exists(getcwd().$moduleConfig) === true) {
			$nowModule = __NAMESPACE__;
			$config = include getcwd().$moduleConfig;
		}
		if (isset($config['view_manager']) === false) {
			$config['view_manager'] = array();
			if (isset($config['view_manager']['template_path_stack']) === false) {
				$config['view_manager']['template_path_stack'] = array();
			}
		}
		$config['view_manager']['template_path_stack'][] = getcwd().'/resources/'.__PROJECT__.'/views';
		$config['view_manager']['template_path_stack'][] = getcwd().'/local/resources/'.__PROJECT__.'/views';
        return $config;
    }

    public function getAutoloaderConfig() {
        return array(
            'Dream\Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => 'resources/'.__PROJECT__.'/sources/'.__NAMESPACE__,
					'ShareResources' => 'resources/ShareResources/sources',
                ),
            ),
        );
    }
}
