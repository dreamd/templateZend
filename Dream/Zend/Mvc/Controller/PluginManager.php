<?php

namespace Dream\Zend\Mvc\Controller;

use Zend\Mvc\Controller\PluginManager as ZendPluginManager;

class PluginManager extends ZendPluginManager {
    protected $invokableClasses = array(
		//Zend build in plugins
        'flashmessenger' 		=> 'Zend\Mvc\Controller\Plugin\FlashMessenger',
        'forward'         			=> 'Zend\Mvc\Controller\Plugin\Forward',
        'layout'          				=> 'Zend\Mvc\Controller\Plugin\Layout',
        'params'          			=> 'Zend\Mvc\Controller\Plugin\Params',
        'postredirectget' 		=> 'Zend\Mvc\Controller\Plugin\PostRedirectGet',
        'redirect'        			=> 'Zend\Mvc\Controller\Plugin\Redirect',
        'url'            					=> 'Zend\Mvc\Controller\Plugin\Url',
		//fast plugin to get all name
		'modulename'      		=> 'Dream\Zend\Mvc\Controller\Plugin\ModuleName',
		'controllername'			=> 'Dream\Zend\Mvc\Controller\Plugin\ControllerName',
		'controllerfullname'	=> 'Dream\Zend\Mvc\Controller\Plugin\ControllerFullName',
		'actionname'				=> 'Dream\Zend\Mvc\Controller\Plugin\ActionName',
		'routename'					=> 'Dream\Zend\Mvc\Controller\Plugin\RouteName',
		//
		'setheader'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetHeader',
		'getstatuscode'			=> 'Dream\Zend\Mvc\Controller\Plugin\GetStatusCode',
		'setstatuscode'			=> 'Dream\Zend\Mvc\Controller\Plugin\SetStatusCode',
		'getparam'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetParam',
		'setparam'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetParam',
		//fast plugin to use controller plugin
		'redirectroute'			=> 'Dream\Zend\Mvc\Controller\Plugin\RedirectRoute',
		'redirecturl'				=> 'Dream\Zend\Mvc\Controller\Plugin\RedirectUrl',
		'baseurl'						=> 'Dream\Zend\Mvc\Controller\Plugin\BaseUrl',
		//some plugin dont use request function
		'getpost'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetPost',
		'setpost'						=> 'Dream\Zend\Mvc\Controller\Plugin\SetPost',
		'getquery'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetQuery',
		'setquery'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetQuery',
		'getfiles'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetFiles',
		'setfiles'						=> 'Dream\Zend\Mvc\Controller\Plugin\SetFiles',
		'setmethod'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetMethod',
    );
    protected $aliases = array(
        'prg'             => 'postredirectget',
    );
	public function has($name = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			if (array_key_exists($name, $this->invokableClasses)) {
				return true;
			}
		}
		return false;
	}
}
