<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsMobile extends AbstractPlugin {
    public function __invoke() {
		$isMobile = $this->getController()->getBrowser('isMobileDevice', false);
		if ($isMobile === true) {
			return $isMobile;
		}
	
		$checks = array(
			array(
				'browser_name_regex',
				'browser_name_pattern',
				'Parent'
			)
		);
		$match = array(
			array(
				'/mobile/i'
			)
		);
		for ($i = 0; $i < count($checks); $i++) {
			for ($j = 0; $j < count($checks[$i]); $j++) {
				$check = $this->getController()->getBrowser($checks[$i][$j], NULL);
				for ($k = 0; $k < count($match[$i]); $k++) {
					if ($check !== NULL && (bool)preg_match($match[$i][$k], $check) === true) {
						return true;
					}
				}
			}
		}
		return false;
    }
}
