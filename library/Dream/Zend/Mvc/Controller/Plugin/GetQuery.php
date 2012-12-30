<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetQuery extends AbstractPlugin {
    public function __invoke($names = NULL, $default = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		$querys = $this->getController()->getRequest()->getQuery()->toArray();
		
		if (empty($names) !== true && is_array($names) === true) {
			for ($i = 0; $i < count($names); $i++) {
				if (isset($querys[$names[$i]]) === true) {
					$querys = $querys[$names[$i]];
				} else {
					return $default;
				}
			}
		}
		return $querys;
    }
}
