<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetHeader extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL && is_string($name) === true) {
			$this->getController()->getResponse()->getHeaders()->addHeaderLine($name, $value);
		}
		return $this->getController();
    }
}
