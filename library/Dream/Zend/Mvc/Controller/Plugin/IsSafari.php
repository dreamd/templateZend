<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsSafari extends AbstractPlugin {
    public function __invoke() {
		$platform = $this->getController()->getBrowser('Browser', false);
		if ((bool)preg_match('/safari/i', $platform) === true) {
			return true;
		}
		$checks = array(
			array(
				'Parent',
				'Comment',
			)
		);
		$match = array(
			array(
				'/safari/i'
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
