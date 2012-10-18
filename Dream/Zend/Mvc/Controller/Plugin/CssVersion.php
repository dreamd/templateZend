<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class CssVersion extends AbstractPlugin {
    public function __invoke() {
		$cssVersion = (int)$this->getController()->getBrowser('cssversion', 'UNKNOWN');
		return is_int($cssVersion) === true ? $cssVersion : false;
    }
}
