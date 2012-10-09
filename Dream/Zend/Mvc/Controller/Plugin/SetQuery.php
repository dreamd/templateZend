<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetQuery extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL && is_string($name) === true && empty($name) === false) {
			$param = new Parameters(array($name => $value));
			$this->getController()->getRequest()->setQuery($param);
		}
		return $this->getController();
    }
}
