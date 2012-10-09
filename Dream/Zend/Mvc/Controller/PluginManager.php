<?php

namespace Dream\Zend\Mvc\Controller;

use Zend\Mvc\Controller\PluginManager as ZendPluginManager;

class PluginManager extends ZendPluginManager {
    protected $invokableClasses = array(
        'flashmessenger' 	=> 'Zend\Mvc\Controller\Plugin\FlashMessenger',
        'forward'         		=> 'Zend\Mvc\Controller\Plugin\Forward',
        'layout'          			=> 'Zend\Mvc\Controller\Plugin\Layout',
        'params'          		=> 'Zend\Mvc\Controller\Plugin\Params',
        'postredirectget' 	=> 'Zend\Mvc\Controller\Plugin\PostRedirectGet',
        'redirect'        		=> 'Zend\Mvc\Controller\Plugin\Redirect',
        'url'            				=> 'Zend\Mvc\Controller\Plugin\Url',
		'modulename'      	=> 'Dream\Zend\Mvc\Controller\Plugin\ModuleName',
		'controllername'		=> 'Dream\Zend\Mvc\Controller\Plugin\controllerName',
    );
    protected $aliases = array(
        'prg'             => 'postredirectget',
    );
}