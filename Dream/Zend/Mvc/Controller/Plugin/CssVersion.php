<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class CssVersion extends AbstractPlugin {
    public function __invoke() {
		return (bool)$this->getController()->getBrowser('cssversion', false);
    }
}
