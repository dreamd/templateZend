<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ViewResolverFactory as ZendViewResolverFactory;
use Dream\Zend\View\Resolver\AggregateResolver, Zend\ServiceManager\FactoryInterface, Zend\ServiceManager\ServiceLocatorInterface;

class ViewResolverFactory extends ZendViewResolverFactory {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $resolver = new AggregateResolver();
        $resolver->attach($serviceLocator->get('ViewTemplateMapResolver'));
        $resolver->attach($serviceLocator->get('ViewTemplatePathStack'));
        return $resolver;
    }
}
