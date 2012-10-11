<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetUri extends AbstractPlugin {
    public function __invoke($uri) {
		$this->getController()->getRequest()->setUri($uri);
		return $this->getController();
    }
}
