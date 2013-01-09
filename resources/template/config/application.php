<?php
return array(
    'modules' => array(
        'Application',
		'Share'
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            getcwd().'/resources/'.__PROJECT__.'/config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            getcwd().'/resources/'.__PROJECT__.'/modules',
			getcwd().'/resources/ShareResources/modules',
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
