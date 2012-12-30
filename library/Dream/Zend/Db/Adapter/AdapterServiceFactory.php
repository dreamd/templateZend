<?php

namespace Dream\Zend\Db\Adapter;

use Zend\Db\Adapter\AdapterServiceFactory AS ZendAdapterServiceFactory;
use Zend\ServiceManager\ServiceLocatorInterface, Dream\Zend\Db\Adapter\Adapter;

class AdapterServiceFactory extends ZendAdapterServiceFactory {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('Configuration');
        return new Adapter(isset($config['db']) === true ? $config['db'] : NULL);
    }
}
