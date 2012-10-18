<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsIe extends AbstractPlugin {
    public function __invoke() {
		$platform = (bool)$this->getController()->getBrowser('browser', false);
		if ((bool)preg_match('/ie/i', $platform) === true) {
			return true;
		}
		$checks = array(
			array(
				'parent',
				'comment',
			)
		);
		$match = array(
			array(
				'/ie/i'
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