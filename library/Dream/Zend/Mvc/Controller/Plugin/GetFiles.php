<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetFiles extends AbstractPlugin {
    public function __invoke($names = NULL, $default = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		$files = $this->getController()->getRequest()->getFiles()->toArray();
		
		if (empty($names) !== true && is_array($names) === true) {
			for ($i = 0; $i < count($names); $i++) {
				if (isset($files[$names[$i]]) === true) {
					$files = $files[$names[$i]];
				} else {
					return $default;
				}
			}
		}
		return $files;
    }
}
