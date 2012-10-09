<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class ActionName extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getEvent()->getRouteMatch()->getParam('action', NULL);
    }
}
