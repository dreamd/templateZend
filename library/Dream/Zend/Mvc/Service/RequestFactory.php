<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\RequestFactory as ZendRequestFactory;

use Dream\ Zend\Http\PhpEnvironment\Request, Zend\ServiceManager\ServiceLocatorInterface;

class RequestFactory extends ZendRequestFactory {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new Request();
    }
}
