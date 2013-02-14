<?php
return array(
    'modules' => array(
        'Application',
		'Share'
    ),
	'mode' => 'DEVELOPMENT',
	//DEVELOPMENT or PRODUCTION
	'time_zone' => 'Asia/Hong_Kong',
	'error_log' => true,
    'module_listener_options' => array(
        'config_glob_paths'    => array(
			'Local/resources/'.$project.'/config/autoload/{,*.}{global,local}.php',
            'resources/'.$project.'/config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            'Local/resources/'.$project.'/modules',
			'Local/resources/ShareResources/modules',
            'resources/'.$project.'/modules',
			'resources/ShareResources/modules',
        ),
    ),
	'service_manager' => array(
		'factories' => array(
			'ServiceListener' => 'Dream\Zend\Mvc\Service\ServiceListenerFactory'
		),
	),
	'databases' => array(
		'local' => array(
 		   'driver' => 'Mysqli',
    		'database' => 'zend_db_example',
			'username' => 'developer',
			'password' => 'developer-password',
		),
	)
);
