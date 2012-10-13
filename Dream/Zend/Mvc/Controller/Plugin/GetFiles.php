<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetFiles extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL, array $option = array()) {
		if ($name !== NULL && is_string($name) === true) {
			$files = $this->getController()->getRequest()->getFiles($name, $default);
			if (is_array($files) === true) {
				for ($i = 0; $i < count($option); $i++) {
					if (isset($files[$option[$i]]) === true) {
						$files = $files[$option[$i]];
					} else {
						return $default;
					}
				}
			}
			return $files;
		}
		return $default;
    }
}
