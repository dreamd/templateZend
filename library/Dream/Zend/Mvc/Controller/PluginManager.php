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
		'getparams'					=> 'Dream\Zend\Mvc\Controller\Plugin\GetParams',
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
		'ismac'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsMac',
		'isios'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIos',
		'isipad'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsIpad',
		'isiphone'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsIphone',
		'isipod'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsIpod',
		'islinux'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsLinux',
		'iswinxp'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWinXp',
		'iswinvista'					=> 'Dream\Zend\Mvc\Controller\Plugin\IsWinVista',
		'iswin7'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin7',
		'iswin8'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin8',
		'iswin16'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin16',
		'iswin32'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin32',
		'iswin64'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsWin64',
		'ischrome'					=> 'Dream\Zend\Mvc\Controller\Plugin\IsChrome',
		'isie'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIe',
		'isie6'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIe6',
		'isie7'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIe7',
		'isie8'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIe8',
		'isie9'							=> 'Dream\Zend\Mvc\Controller\Plugin\IsIe9',
		'isfirefox'					=> 'Dream\Zend\Mvc\Controller\Plugin\IsFirefox',
		'issafari'						=> 'Dream\Zend\Mvc\Controller\Plugin\IsSafari',
		'cancookies'				=> 'Dream\Zend\Mvc\Controller\Plugin\CanCookies',
		'canjavascript'			=> 'Dream\Zend\Mvc\Controller\Plugin\CanJavaScript',
		'canjavaapplets'			=> 'Dream\Zend\Mvc\Controller\Plugin\CanJavaApplets',
		'canvbscript'				=> 'Dream\Zend\Mvc\Controller\Plugin\CanVbScript',
		'canbgsounds'				=> 'Dream\Zend\Mvc\Controller\Plugin\CanBgSounds',
		'caniframes'				=> 'Dream\Zend\Mvc\Controller\Plugin\CanIframes',
		'canframes'					=> 'Dream\Zend\Mvc\Controller\Plugin\CanFrames',
		'cantables'					=> 'Dream\Zend\Mvc\Controller\Plugin\CanTables',
		//combination
		'combination'         => 'Dream\Zend\Mvc\Controller\Plugin\Combination',
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
