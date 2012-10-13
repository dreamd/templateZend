<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class BaseUrl extends AbstractPlugin {
    public function __invoke($route = NULL, array $params = array()) {
		return $this->getController()->url()->fromRoute($route, $params);
	}
}
