<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class CanCookies extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getBrowser('Cookies', false);
    }
}
