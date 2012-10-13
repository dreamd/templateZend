<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetQuery extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL, array $option = array()) {
		if ($name !== NULL && is_string($name) === true) {
			$querys = $this->getController()->getRequest()->getQuery($name, $default);
			if (is_array($querys) === true) {
				for ($i = 0; $i < count($option); $i++) {
					if (isset($querys[$option[$i]]) === true) {
						$querys = $querys[$option[$i]];
					} else {
						return $default;
					}
				}
			}
			return $querys;
		}
		return $default;
    }
}
