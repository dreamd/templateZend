<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ControllerFullName extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getEvent()->getRouteMatch()->getParam('controller', NULL);
	}
}
