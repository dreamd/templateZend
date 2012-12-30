<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class RedirectUrl extends AbstractPlugin {
    public function __invoke($link = NULL) {
		if ($link !== NULL && is_string($link) === true) {
			$this->getController()->redirect()->toUrl($link);
		}
		return $this->getController();
	}
}
