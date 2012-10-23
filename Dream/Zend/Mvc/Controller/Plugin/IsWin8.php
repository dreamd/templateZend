<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class IsWin8 extends AbstractPlugin {
    public function __invoke() {
		$isWin16 = $this->getController()->getBrowser('Win16', false);
		$isWin32 = $this->getController()->getBrowser('Win32', false);
		$isWin64 = $this->getController()->getBrowser('Win64', false);
		$platformVersion = $this->getController()->getBrowser('Platform_Version', false);
		if ($isWin16 === true || $isWin32 === true || $isWin64 === true) {
			if ($platformVersion === '6.2') {
				return true;	
			}
		}
		
		$checks = array(
			array(
				'Platform'
			),
			array(
				'browser_name_regex',
				'browser_name_pattern',
			)
		);
		$match = array(
			array(
				'/win8/i'
			),
			array(
				'/windows(\s)?nt(\s)?6\\\.2/i',
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
