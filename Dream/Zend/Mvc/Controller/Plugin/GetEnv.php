<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetEnv extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		return $this->getController()->getRequest()->getEnv($name, $default);
    }
}
