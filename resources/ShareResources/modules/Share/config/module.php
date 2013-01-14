<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
			/*
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/test',
                    'defaults' => array(
                        'controller' => 'Test\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
			*/
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'share' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/share',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Share\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Share\Controller\Index' => 'Share\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => false,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => getcwd().'/resources/ShareResources/views/Layout/Layout.phtml',
            'share/index/index' => getcwd().'/resources/ShareResources/views/Share/Index/Index.phtml',
			'share/index/test' => getcwd().'/resources/ShareResources/views/Share/Index/Test.phtml',
            'error/404'               => getcwd().'/resources/ShareResources/views/Error/404.phtml',
            'error/index'             => getcwd().'/resources/ShareResources/views/Error/Index.phtml',
        ),
        'template_path_stack' => array(
        ),
    ),
);
