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
		if (file_exists($path = $localPath.$moduleConfig) === true) {
			$nowModule = __NAMESPACE__;
			return include $path;
		} else if (file_exists(getcwd().$moduleConfig) === true) {
			$nowModule = __NAMESPACE__;
			return include getcwd().$moduleConfig;
		}
        return array();
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
