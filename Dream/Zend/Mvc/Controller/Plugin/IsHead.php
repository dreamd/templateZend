<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class IsHead extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getRequest()->isHead();
    }
}
