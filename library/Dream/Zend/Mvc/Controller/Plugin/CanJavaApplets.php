<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class CanJavaApplets extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getBrowser('JavaApplets', false);
    }
}
