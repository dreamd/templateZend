<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsIpad extends AbstractPlugin {
    public function __invoke() {
		$platform = $this->getController()->getBrowser('platform', false);
		if ((bool)preg_match('/ios/i', $platform) === true) {
			$checks = array(
				array(
					'browser_name_regex',
					'browser_name_pattern',
				)
			);
			$match = array(
				array(
					'/ipad/i'
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
		}
		return false;
    }
}
