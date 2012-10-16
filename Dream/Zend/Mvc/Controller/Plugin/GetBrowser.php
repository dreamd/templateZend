<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetBrowser extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		$browser = get_browser(null);
		if ($name !== NULL) {
			if (is_string($name) === true && isset($browser->{strtolower($name)}) === true) {
			return $browser->{strtolower($name)};	
			}
			return $default;
		}
		return $browser;
    }
}
