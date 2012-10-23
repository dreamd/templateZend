<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Dream\PhpBrowscap\Browscap, Zend\Session\Container;
 
class GetBrowser extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		$browscapSession = new Container('Browscap');
		 if (isset($browscapSession->browser) === false) {
			$browscap = new Browscap('cache');
    		$browscapSession->browser = $browscap->getBrowser();
		 }
		if ($name !== NULL) {
			if (is_string($name) === true && isset($browscapSession->browser->$name) === true) {
				return $browscapSession->browser->$name;	
			}
			return $default;
		}
		return $browscapSession->browser;
    }
}
