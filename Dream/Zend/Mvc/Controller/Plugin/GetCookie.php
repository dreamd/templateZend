<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetCookie extends AbstractPlugin {
    public function __invoke($names = NULL, $default = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		$cookies = $this->getController()->getRequest()->getCookie()->getArrayCopy();
		
		if (empty($names) !== true && is_array($names) === true) {
			for ($i = 0; $i < count($names); $i++) {
				if (isset($cookies[$names[$i]]) === true) {
					$cookies = $cookies[$names[$i]];
				} else {
					return $default;
				}
			}
		}
		return $cookies;
    }
}
