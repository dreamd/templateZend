<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetPost extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL) {
		return $this->getController()->getRequest()->getPost($name, $default);
    }
}
