<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ViewManagerFactory as ZendViewManagerFactory;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Console\Console as Console;
use Zend\Mvc\View\Console\ViewManager as ConsoleViewManager;
use Dream\Zend\Mvc\View\Http\ViewManager as HttpViewManager;

class ViewManagerFactory extends ZendViewManagerFactory {
	public function createService(ServiceLocatorInterface $serviceLocator) {
        if (Console::isConsole() === true) {
            return new ConsoleViewManager();
        }
        return new HttpViewManager();
    }
}
