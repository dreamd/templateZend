<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetFiles extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL && is_string($name) === true) {
			$param = new Parameters(array($name => $value));
			$this->getController()->getRequest()->setFiles($param);
		}
		return $this->getController();
    }
}
