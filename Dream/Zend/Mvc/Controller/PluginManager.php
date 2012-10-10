<?php

namespace Dream\Zend\Mvc\Controller;

use Zend\Mvc\Controller\PluginManager as ZendPluginManager;

class PluginManager extends ZendPluginManager {
    protected $invokableClasses = array(
        'flashmessenger' 		=> 'Zend\Mvc\Controller\Plugin\FlashMessenger',
        'forward'         			=> 'Zend\Mvc\Controller\Plugin\Forward',
        'layout'          				=> 'Zend\Mvc\Controller\Plugin\Layout',
        'params'          			=> 'Zend\Mvc\Controller\Plugin\Params',
        'postredirectget' 		=> 'Zend\Mvc\Controller\Plugin\PostRedirectGet',
        'redirect'        			=> 'Zend\Mvc\Controller\Plugin\Redirect',
        'url'            					=> 'Zend\Mvc\Controller\Plugin\Url',
		'modulename'      		=> 'Dream\Zend\Mvc\Controller\Plugin\ModuleName',
		'controllername'			=> 'Dream\Zend\Mvc\Controller\Plugin\ControllerName',
		'controllerfullname'	=> 'Dream\Zend\Mvc\Controller\Plugin\ControllerFullName',
		'actionname'				=> 'Dream\Zend\Mvc\Controller\Plugin\ActionName',
		'routename'					=> 'Dream\Zend\Mvc\Controller\Plugin\RouteName',
		'ispost'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsPost',
		'getpost'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetPost',
		'setpost'						=> 'Dream\Zend\Mvc\Controller\Plugin\SetPost',
		'isget'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsGet',
		'getquery'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetQuery',
		'setquery'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetQuery',
		'getfiles'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetFiles',
		'setfiles'						=> 'Dream\Zend\Mvc\Controller\Plugin\SetFiles',
		'getcookie'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetCookie',
		'getheader'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetHeader',
		'setheader'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetHeader',
		'isoptions'					=> 'Dream\Zend\Mvc\Controller\Plugin\IsOptions',
		'ishead'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsHead',
		'isput'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsPut',
		'isdelete'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsDelete',
		'istrace'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsTrace',
		'isconnect'					=> 'Dream\Zend\Mvc\Controller\Plugin\IsConnect',
		'ispatch'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsPatch',
		'isxmlhttprequest'		=> 'Dream\Zend\Mvc\Controller\Plugin\IsXmlHttpRequest',
		'isflashrequest'			=> 'Dream\Zend\Mvc\Controller\Plugin\IsFlashRequest',
		'getstatuscode'			=> 'Dream\Zend\Mvc\Controller\Plugin\GetStatusCode',
		'setstatuscode'			=> 'Dream\Zend\Mvc\Controller\Plugin\SetStatusCode',
		'getparam'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetParam',
		'setparam'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetParam',
		/*
		'redirectroute'			=> 'Dream\Zend\Mvc\Controller\Plugin\RedirectRoute',
		'redirecturl'				=> 'Dream\Zend\Mvc\Controller\Plugin\RedirectUrl',
		'getlink'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetLink',
		*/
    );
    protected $aliases = array(
        'prg'             => 'postredirectget',
    );
}
