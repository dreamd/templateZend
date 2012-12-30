<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetFiles extends AbstractPlugin {
    public function __invoke($names = NULL, $value = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		
		if (empty($names) !== true && is_array($names) === true) {
			$files = $this->getController()->getRequest()->getFiles()->toArray();
			$tempFiles = &$files;
			for ($i = 0; $i < count($names); $i++) {
				if ($i === count($names) - 1) {
					$tempFiles[$names[$i]]	 = $value;
				} else {
					if (isset($tempFiles[$names[$i]]) === false) {
						$tempFiles[$names[$i]]	 = array();
					}
					$tempFiles = &$tempFiles[$names[$i]];
				}
			}
			$this->getController()->getRequest()->setFiles(new Parameters($files));
		}
		return $this->getController();
    }
}
