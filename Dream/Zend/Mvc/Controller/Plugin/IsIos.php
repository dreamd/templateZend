<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsIos extends AbstractPlugin {
    public function __invoke() {
		$checks = array(
			array(
				'platform'
			),
			array(
				'browser_name_regex',
				'browser_name_pattern',
			)
		);
		$match = array(
			array(
				'ios'
			),
			array(
				'ipad',
				'iphone',
				'ipod'
			)
		);
		for ($i = 0; $i < count($checks); $i++) {
			for ($j = 0; $j < count($checks[$i]); $j++) {
				$check = $this->getController()->getBrowser($checks[$i][$j], 'UNKNOWN');
				for ($k = 0; $k < count($match[$i]); $k++) {
					if ((bool)preg_match('/'.$match[$i][$k].'/i', $check) === true) {
						return true;
					}
				}
			}
		}
		return false;
    }
}
