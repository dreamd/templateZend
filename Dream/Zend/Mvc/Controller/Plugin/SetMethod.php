<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetMethod extends AbstractPlugin {
    public function __invoke($method) {
		$method = strtoupper($method);
        if (defined('Zend\Http\Request::METHOD_' . $method)) {
			$this->getController()->getRequest()->setMethod($method);
		}
		return $this->getController();
    }
}
