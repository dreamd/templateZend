<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class IsFlashRequest extends AbstractPlugin {
    public function __invoke() {
		return $this->getController()->getRequest()->isFlashRequest();
    }
}
