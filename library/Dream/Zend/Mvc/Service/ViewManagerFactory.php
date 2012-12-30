<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ViewManagerFactory as ZendViewManagerFactory;
use Dream\Zend\Mvc\View\Http\ViewManager as ViewManager;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewManagerFactory extends ZendViewManagerFactory {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new ViewManager();
    }
}
