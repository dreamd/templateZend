<?php

namespace Application;

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
		$moduleConfig = '/resources/'.$application->getProject().'/modules/'.__NAMESPACE__.'/config/module.php';
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
		$config['view_manager']['template_path_stack'][] = getcwd().'/resources/'.$application->getProject().'/views';
		$config['view_manager']['template_path_stack'][] = getcwd().'/local/resources/'.$application->getProject().'/views';
        return $config;
    }

    public function getAutoloaderConfig() {
		$application = Application::getApplication();
        return array(
            'Dream\Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => 'resources/'.$application->getProject().'/sources/'.__NAMESPACE__,
					'ShareResources' => 'resources/ShareResources/sources',
                ),
            ),
        );
    }
}
