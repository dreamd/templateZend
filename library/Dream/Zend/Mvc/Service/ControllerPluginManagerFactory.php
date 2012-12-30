<?php
namespace Dream\Zend\Mvc\Service;
use Zend\Mvc\Service\ControllerPluginManagerFactory as ZendControllerPluginManagerFactory;

class ControllerPluginManagerFactory extends ZendControllerPluginManagerFactory {
    const PLUGIN_MANAGER_CLASS = 'Dream\Zend\Mvc\Controller\PluginManager';
}
