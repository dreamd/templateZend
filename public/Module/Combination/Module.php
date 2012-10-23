<?php

namespace Combination;

use Zend\Mvc\ModuleRouteListener;

class Module {
    public function onBootstrap($e) {
        $e->getApplication()->getServiceManager()->get('translator');
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
    public function getConfig() {
        return include __DIR__ . '/Config/ModuleConfig.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.DIRECTORY_SEPARATOR.'Source/'.DIRECTORY_SEPARATOR.__NAMESPACE__,
                ),
            ),
        );
    }
}
