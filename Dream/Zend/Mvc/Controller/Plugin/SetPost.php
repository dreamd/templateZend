<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetPost extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL && is_string($name) === true && empty($name) === false) {
			$param = new Parameters(array($name => $value));
			$this->getController()->getRequest()->setPost($param);
		}
		return $this->getController();
    }
}
