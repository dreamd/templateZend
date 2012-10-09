<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetFiles extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			return $this->getController()->getRequest()->getFiles($name, $default);
		}
		return $default;
    }
}
