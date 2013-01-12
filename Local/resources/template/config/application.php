<?php
return array(
    'modules' => array(
        'Application',
		'Share'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
			'Local/resources/'.__PROJECT__.'/config/autoload/{,*.}{global,local}.php',
            'resources/'.__PROJECT__.'/config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            'Local/resources/'.__PROJECT__.'/modules',
			'Local/resources/ShareResources/modules',
            'resources/'.__PROJECT__.'/modules',
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
