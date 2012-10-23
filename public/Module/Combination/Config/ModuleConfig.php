<?php
return array(
    'router' => array(
        'routes' => array(

            'Css' => array(
                'type' => 'segment',
                'options' => array(
					'route' => '/Css[/:action][/:name]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
                    'defaults' => array(
                        'controller' => 'Combination\Controller\Css',
                        'action'     => 'index',
						'name' => ''
                    ),
                ),
            ),

            'Less' => array(
                'type' => 'segment',
                'options' => array(
					'route' => '/Less[/:action][/:name]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
                    'defaults' => array(
                        'controller' => 'Combination\Controller\Less',
                        'action'     => 'index',
						'name' => ''
                    ),
                ),
            ),
			
            'Js' => array(
                'type' => 'segment',
                'options' => array(
					'route' => '/Js[/:action][/:name]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
                    'defaults' => array(
                        'controller' => 'Combination\Controller\Js',
                        'action'     => 'index',
						'name' => ''
                    ),
                ),
            ),
			
            'Jquery' => array(
                'type' => 'segment',
                'options' => array(
					'route' => '/Jquery[/:action][/:name]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'name' => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
                    'defaults' => array(
                        'controller' => 'Combination\Controller\Jquery',
                        'action'     => 'index',
						'name' => ''
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
                'base_dir' => __DIR__ . '/../Language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
			'Combination\Controller\Css' => 'Combination\Controller\CssController',
			'Combination\Controller\Less' => 'Combination\Controller\LessController',
			'Combination\Controller\Js' => 'Combination\Controller\JsController',
			'Combination\Controller\Jquery' => 'Combination\Controller\JqueryController',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
			'layout/layout'               => __DIR__ . '/../Source/Application/View/Error/404.phtml',
            'error/404'               => __DIR__ . '/../Source/Application/View/Error/404.phtml',
            'error/index'             => __DIR__ . '/../Source/Application/View/Error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../Source/Combination/View',
        ),
    ),
);
