<?php
return array(
    'modules' => array(
        'Application',
		'Combination',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'ZendConfig/AutoLoad/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            './Module'
        ),
		"config_static_paths" => array(),
		"extra_config" => array(),
    ),
	"service_manager" => array(
		"invokables" => array(
			'SharedEventManager' => 'Zend\EventManager\SharedEventManager',
		),
		"factories" => array(
			'EventManager'  => 'Zend\Mvc\Service\EventManagerFactory',
			'ModuleManager' => 'Zend\Mvc\Service\ModuleManagerFactory',
			'ServiceListener' => 'Dream\Zend\Mvc\Service\ServiceListenerFactory'
		),
		"abstract_factories" => array(
		
		),
		"aliases" => array(
			'Zend\EventManager\EventManagerInterface' => 'EventManager',
		),
		"shared" => array(
			'EventManager' => false,
		),
	),
	"service_listener_options" => array(
		//"whatKey" => array(
		//	"service_manager" => "???",
		//	"config_key" => "???",
		//	"interface" => "???",
		//	"method" => "???",
		//)
	),
);
