<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetStatusCode extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getResponse()->getStatusCode();
    }
}
