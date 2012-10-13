<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetFiles extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL && is_string($name) === true) {
			$files = $this->getController()->getRequest()->getFiles();
			$files->set($name, $value);
			$this->getController()->getRequest()->setFiles($files);
		}
		return $this->getController();
    }
}
