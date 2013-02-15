<?php

namespace Browser;

use Zend\Mvc\ModuleRouteListener, Zend\Mvc\MvcEvent, Dream\Application\Application;

class Module {
    public function onBootstrap(MvcEvent $e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    public function getConfig() {
		$application = Application::getApplication();
		$moduleConfig = '/resources/ShareResources/modules/'.__NAMESPACE__.'/config/module.php';
		$localPath = 'local/';
		$config = array();
		if (file_exists($path = $localPath.$moduleConfig) === true) {
			$config = include $path;
		} else if (file_exists($path = getcwd().$moduleConfig) === true) {
			$config = include $path;
		}
		if (isset($config['view_manager']) === false) {
			$config['view_manager'] = array();
			if (isset($config['view_manager']['template_path_stack']) === false) {
				$config['view_manager']['template_path_stack'] = array();
			}
		}
        return $config;
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => realpath(getcwd().'/resources/ShareResources/sources/'.__NAMESPACE__),
					'ShareResources' => realpath(getcwd().'/resources/ShareResources/sources'),
                ),
            ),
        );
    }
}
