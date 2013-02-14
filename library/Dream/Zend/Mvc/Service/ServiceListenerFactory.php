<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ServiceListenerFactory as ZendServiceListenerFactory;

class ServiceListenerFactory extends ZendServiceListenerFactory {
    protected $defaultServiceConfig = array(
        'invokables' => array(
            'DispatchListener'     => 'Zend\Mvc\DispatchListener',
            'RouteListener'        => 'Zend\Mvc\RouteListener',
            'SendResponseListener' => 'Zend\Mvc\SendResponseListener'
        ),
        'factories' => array(
            'Application'							=> 'Zend\Mvc\Service\ApplicationFactory',
            'Config'									=> 'Zend\Mvc\Service\ConfigFactory',
            'ControllerLoader'					=> 'Zend\Mvc\Service\ControllerLoaderFactory',
            'ControllerPluginManager'		=> 'Zend\Mvc\Service\ControllerPluginManagerFactory',//will change
            'ConsoleAdapter'					=> 'Zend\Mvc\Service\ConsoleAdapterFactory',
            'ConsoleRouter'						=> 'Zend\Mvc\Service\RouterFactory',
            'DependencyInjector'				=> 'Zend\Mvc\Service\DiFactory',
            'DiAbstractServiceFactory'       => 'Zend\Mvc\Service\DiAbstractServiceFactoryFactory',
            'DiServiceInitializer'           => 'Zend\Mvc\Service\DiServiceInitializerFactory',
            'DiStrictAbstractServiceFactory' => 'Zend\Mvc\Service\DiStrictAbstractServiceFactoryFactory',
            'FilterManager'                  => 'Zend\Mvc\Service\FilterManagerFactory',
            'FormElementManager'             => 'Zend\Mvc\Service\FormElementManagerFactory',
            'HttpRouter'							=> 'Zend\Mvc\Service\RouterFactory',
			'PaginatorPluginManager'         => 'Zend\Mvc\Service\PaginatorPluginManagerFactory',
            'Request'									=> 'Zend\Mvc\Service\RequestFactory',//will change
            'Response'								=> 'Zend\Mvc\Service\ResponseFactory',
            'Router'									=> 'Zend\Mvc\Service\RouterFactory',
			'RoutePluginManager'             => 'Zend\Mvc\Service\RoutePluginManagerFactory',
			'ValidatorManager'				=> 'Zend\Mvc\Service\ValidatorManagerFactory',
            'ViewHelperManager'				=> 'Dream\Zend\Mvc\Service\ViewHelperManagerFactory',
            'ViewFeedRenderer'				=> 'Zend\Mvc\Service\ViewFeedRendererFactory',
            'ViewFeedStrategy'				=> 'Zend\Mvc\Service\ViewFeedStrategyFactory',
            'ViewJsonRenderer'				=> 'Zend\Mvc\Service\ViewJsonRendererFactory',
            'ViewJsonStrategy'				=> 'Zend\Mvc\Service\ViewJsonStrategyFactory',
            'ViewManager'						=> 'Dream\Zend\Mvc\Service\ViewManagerFactory',
            'ViewResolver'							=> 'Zend\Mvc\Service\ViewResolverFactory',
            'ViewTemplateMapResolver'	=> 'Zend\Mvc\Service\ViewTemplateMapResolverFactory',
            'ViewTemplatePathStack'		=> 'Dream\Zend\Mvc\Service\ViewTemplatePathStackFactory',
        ),
        'aliases' => array(
            'Configuration'													=> 'Config',
            'Console'																=> 'ConsoleAdapter',
            'Di'																		=> 'DependencyInjector',
            'Zend\Di\LocatorInterface'								=> 'DependencyInjector',
            'Zend\Mvc\Controller\PluginManager'				=> 'ControllerPluginManager',
            'Zend\View\Resolver\TemplateMapResolver'	=> 'ViewTemplateMapResolver',
            'Zend\View\Resolver\TemplatePathStack'		=> 'ViewTemplatePathStack',
            'Zend\View\Resolver\AggregateResolver'		=> 'ViewResolver',
            'Zend\View\Resolver\ResolverInterface'			=> 'ViewResolver',
        ),
    );
}
