<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetIni extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL, $runTime = true) {
		if ($name !== NULL && is_string($name) === true) {
			if ($runTime === false) {
				$return = get_cfg_var($name);
				return $return === false ? $default : $return;	
			}
			$return = ini_get($name);
			return $return === false ? $default : $return;
		}
		return $default;
	}
}
