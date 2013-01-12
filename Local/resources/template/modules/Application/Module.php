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
        return include __DIR__ . '/config/module.php';
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
