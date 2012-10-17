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
		//fast plugin to use response function
		'setheader'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetHeader',
		'getstatuscode'			=> 'Dream\Zend\Mvc\Controller\Plugin\GetStatusCode',
		'setstatuscode'			=> 'Dream\Zend\Mvc\Controller\Plugin\SetStatusCode',
		//fast plugin to use route function
		'getparam'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetParam',
		'setparam'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetParam',
		//fast plugin to use controller plugin
		'redirectroute'			=> 'Dream\Zend\Mvc\Controller\Plugin\RedirectRoute',
		'redirecturl'				=> 'Dream\Zend\Mvc\Controller\Plugin\RedirectUrl',
		'baseurl'						=> 'Dream\Zend\Mvc\Controller\Plugin\BaseUrl',
		//fast plugin to use request function, some modify
		'getpost'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetPost',
		'setpost'						=> 'Dream\Zend\Mvc\Controller\Plugin\SetPost',
		'getquery'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetQuery',
		'setquery'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetQuery',
		'getfiles'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetFiles',
		'setfiles'						=> 'Dream\Zend\Mvc\Controller\Plugin\SetFiles',
		'setmethod'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetMethod',
		'getini'							=> 'Dream\Zend\Mvc\Controller\Plugin\GetIni',
		'setini'							=> 'Dream\Zend\Mvc\Controller\Plugin\SetIni',
		'getserver'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetServer',
		'getenv'						=> 'Dream\Zend\Mvc\Controller\Plugin\GetEnv',
		'getcookie'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetCookie',
		'setcookie'					=> 'Dream\Zend\Mvc\Controller\Plugin\SetCookie',
		//browscap
		'getbrowser'				=> 'Dream\Zend\Mvc\Controller\Plugin\GetBrowser',
		'cssversion'					=> 'Dream\Zend\Mvc\Controller\Plugin\CssVersion',
		'ismobile'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsMobile',
		'isandroid'					=> 'Dream\Zend\Mvc\Controller\Plugin\IsAndroid',
		'isios'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIos',
		'iswin7'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin7',
		'iswin16'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin16',
		'iswin32'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin32',
		'iswin64'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin64',
		'supportcookies'			=> 'Dream\Zend\Mvc\Controller\Plugin\SupportCookies',
		'supportjavascript'		=> 'Dream\Zend\Mvc\Controller\Plugin\SupportJavaScript',
		'supportjavaapplets'	=> 'Dream\Zend\Mvc\Controller\Plugin\SupportJavaApplets',
		'supportvbscript'		=> 'Dream\Zend\Mvc\Controller\Plugin\SupportVbScript',
		'supportbgsounds'		=> 'Dream\Zend\Mvc\Controller\Plugin\SupportBgSounds',
		'supportiframes'			=> 'Dream\Zend\Mvc\Controller\Plugin\SupportIframes',
		'supportframes'			=> 'Dream\Zend\Mvc\Controller\Plugin\SupportFrames',
		'supporttables'			=> 'Dream\Zend\Mvc\Controller\Plugin\SupportTables',
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
