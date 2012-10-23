<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetParam extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getEvent()->getRouteMatch()->getParams();
    }
}
