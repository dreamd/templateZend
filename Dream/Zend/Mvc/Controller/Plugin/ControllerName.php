<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ControllerName extends AbstractPlugin {
    public function __invoke() {
		$controllerFullName = $this->getController()->getEvent()->getRouteMatch()->getParam('controller', NULL);
		if (is_string($controllerFullName) === true && empty($controllerFullName) === false) {
			return substr($controllerFullName, (strlen($controllerFullName) - strrpos($controllerFullName, '\\')) * -1 + 1);
		}
		var_dump('5555');
		return NULL;
    }
}
