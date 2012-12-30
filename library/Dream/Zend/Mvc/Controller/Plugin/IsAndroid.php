<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsAndroid extends AbstractPlugin {
    public function __invoke() {
		$checks = array(
			'Browser',
			'browser_name_regex',
			'browser_name_pattern',
			'Parent',
			'Platform'
		);
		for ($i = 0; $i < count($checks); $i++) {
			$check = $this->getController()->getBrowser($checks[$i], 'UNKNOWN');
			if ((bool)preg_match('/android/i', $check) === true) {
				return true;
			}
		}
		return false;
    }
}
