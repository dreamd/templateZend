<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsIe9 extends AbstractPlugin {
    public function __invoke() {
		$isIe = $this->getController()->isIe();
		if ($isIe === true) {
			$version = $this->getController()->getBrowser('Version', NULL);
			if ($version !== NULL && is_string($version) === true && substr($version, 0, 1) === '9') {
				return true;	
			}
		}
		return false;
	}
}
