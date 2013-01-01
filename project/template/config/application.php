<?php
return array(
    'modules' => array(
        'Application',
    ),
    'module_listener_options' => array(
        'config_glob_paths'    => array(
            'config/autoload/{,*.}{global,local}.php',
        ),
        'module_paths' => array(
            'module',
        ),
    ),
	"service_manager" => array(
		"factories" => array(
			'ServiceListener' => 'Dream\Zend\Mvc\Service\ServiceListenerFactory'
		),
	)
);
