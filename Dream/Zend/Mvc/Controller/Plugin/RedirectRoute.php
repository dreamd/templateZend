<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class RedirectRoute extends AbstractPlugin {
    public function __invoke($route = NULL, array $params = array(), $options = array(), $reuseMatchedParams = false) {
		if ($route !== NULL) {
			$this->getController()->redirect()->toRoute($route, $params, $options, $reuseMatchedParams);
		}
		return $this->getController();
	}
}
