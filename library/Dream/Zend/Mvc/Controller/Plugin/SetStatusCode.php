<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetStatusCode extends AbstractPlugin {
    public function __invoke($statusCode = 404) {
		if ($statusCode !== NULL && is_int($statusCode) === true) {
			$this->getController()->getResponse()->setStatusCode($statusCode);
		}
		return $this->getController();
    }
}
