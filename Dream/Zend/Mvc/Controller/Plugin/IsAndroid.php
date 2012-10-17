<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsAndroid extends AbstractPlugin {
    public function __invoke() {
		$checks = array(
			'browser',
			'browser_name_regex',
			'browser_name_pattern',
			'parent',
			'platform'
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
