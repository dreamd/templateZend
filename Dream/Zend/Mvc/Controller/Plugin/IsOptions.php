<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class IsOptions extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getRequest()->isOptions();
    }
}
