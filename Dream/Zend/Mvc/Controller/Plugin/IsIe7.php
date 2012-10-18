<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsIe7 extends AbstractPlugin {
    public function __invoke() {
		$isIe = (bool)$this->getController()->isIe();
		if ($isIe === true) {
			$version = $this->getController()->getBrowser('version', NULL);
			if ($version !== NULL && is_string($version) === true && substr($version, 0, 1) === '7') {
				return true;	
			}
		}
		return false;
	}
}
