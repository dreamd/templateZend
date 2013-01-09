<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\RequestFactory as ZendRequestFactory;
use Zend\Console\Request as ConsoleRequest;
use Zend\Console\Console;
use Dream\ Zend\Http\PhpEnvironment\Request as PhpEnvironmentRequest, Zend\ServiceManager\ServiceLocatorInterface;

class RequestFactory extends ZendRequestFactory {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        if (Console::isConsole()) {
            return new ConsoleRequest();
        }
        return new PhpEnvironmentRequest();
    }
}
