<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ServiceListenerFactory as ZendServiceListenerFactory;

class ServiceListenerFactory extends ZendServiceListenerFactory {
    protected $defaultServiceConfig = array(
        'invokables' => array(
            'DispatchListener' => 'Zend\Mvc\DispatchListener',
            'RouteListener'    => 'Zend\Mvc\RouteListener',
        ),
        'factories' => array(
            'Application'             => 'Zend\Mvc\Service\ApplicationFactory',
            'Config'                  => 'Zend\Mvc\Service\ConfigFactory',
            'ControllerLoader'        => 'Zend\Mvc\Service\ControllerLoaderFactory',
            'ControllerPluginManager' => 'Zend\Mvc\Service\ControllerPluginManagerFactory',
            'ConsoleAdapter'          => 'Zend\Mvc\Service\ConsoleAdapterFactory',
            'ConsoleRouter'           => 'Zend\Mvc\Service\RouterFactory',
            'DependencyInjector'      => 'Zend\Mvc\Service\DiFactory',
            'HttpRouter'              => 'Zend\Mvc\Service\RouterFactory',
            'Request'                 => 'Zend\Mvc\Service\RequestFactory',
            'Response'                => 'Zend\Mvc\Service\ResponseFactory',
            'Router'                  => 'Zend\Mvc\Service\RouterFactory',
            'ViewHelperManager'       => 'Dream\Zend\Mvc\Service\ViewHelperManagerFactory',
            'ViewFeedRenderer'        => 'Zend\Mvc\Service\ViewFeedRendererFactory',
            'ViewFeedStrategy'        => 'Zend\Mvc\Service\ViewFeedStrategyFactory',
            'ViewJsonRenderer'        => 'Zend\Mvc\Service\ViewJsonRendererFactory',
            'ViewJsonStrategy'        => 'Zend\Mvc\Service\ViewJsonStrategyFactory',
            'ViewManager'             => 'Dream\Zend\Mvc\Service\ViewManagerFactory',
            'ViewResolver'            => 'Zend\Mvc\Service\ViewResolverFactory',
            'ViewTemplateMapResolver' => 'Zend\Mvc\Service\ViewTemplateMapResolverFactory',
            'ViewTemplatePathStack'   => 'Zend\Mvc\Service\ViewTemplatePathStackFactory',
        ),
        'aliases' => array(
            'Configuration'                          => 'Config',
            'Console'                                => 'ConsoleAdapter',
            'ControllerPluginBroker'                 => 'ControllerPluginManager',
            'Di'                                     => 'DependencyInjector',
            'Zend\Di\LocatorInterface'               => 'DependencyInjector',
            'Zend\Mvc\Controller\PluginBroker'       => 'ControllerPluginBroker',
            'Zend\Mvc\Controller\PluginManager'      => 'ControllerPluginManager',
            'Zend\View\Resolver\TemplateMapResolver' => 'ViewTemplateMapResolver',
            'Zend\View\Resolver\TemplatePathStack'   => 'ViewTemplatePathStack',
            'Zend\View\Resolver\AggregateResolver'   => 'ViewResolver',
            'Zend\View\Resolver\ResolverInterface'   => 'ViewResolver',
        ),
    );
}
