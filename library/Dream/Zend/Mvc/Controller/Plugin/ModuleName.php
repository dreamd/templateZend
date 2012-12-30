<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ModuleName extends AbstractPlugin {
    public function __invoke() {
		$controllerFullName = $this->getController()->getEvent()->getRouteMatch()->getParam('controller', NULL);
		if (is_string($controllerFullName) === true && empty($controllerFullName) === false) {
			return substr($controllerFullName, 0, strpos($controllerFullName, '\\'));
		}
		return NULL;
    }
}
