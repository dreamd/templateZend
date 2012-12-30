<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsWin64 extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getBrowser('Win64', false);
    }
}
