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
		
            'Home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Main',
                        'action'     => 'index',
                    ),
                ),
            ),

            'Application' => array(
                'type' => 'segment',
                'options' => array(
					'route' => '/Main[/:action][/:id]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
                    'defaults' => array(
                        'controller' => 'Application\Controller\Main',
                        'action'     => 'index',
						'id' => 0
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
			'Application\Controller\Main' => 'Application\Controller\MainController',
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
            __DIR__ . '/../Source/Application/View',
        ),
    ),
);
