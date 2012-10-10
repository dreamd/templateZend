<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class GetUrl extends AbstractPlugin {
    public function __invoke($route = NULL, array $params = array()) {
		if ($route !== NULL && is_string($route) === true) {
			return $this->getController()->url()->fromRoute($route, $params);
		}
		return NULL;
	}
}
