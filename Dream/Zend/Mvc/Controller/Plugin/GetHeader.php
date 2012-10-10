<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetHeader extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			return $this->getController()->getRequest()->getHeaders($name, $default);
		}
		return $default;
    }
}
