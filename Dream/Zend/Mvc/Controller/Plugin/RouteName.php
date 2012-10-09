<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class RouteName extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getEvent()->getRouteMatch()->getMatchedRouteName();
    }
}
