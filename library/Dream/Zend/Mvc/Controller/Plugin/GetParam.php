<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetParam extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			return $this->getController()->getEvent()->getRouteMatch()->getParam($name, $default);
		}
		return $default;
    }
}
