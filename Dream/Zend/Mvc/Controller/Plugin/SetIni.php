<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetIni extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		$name = $this->mappingName($name);
		$value = $this->mappingValue($value);
		if ($name !== NULL && is_string($name) === true && $value !== NULL && (is_string($value) === true || is_numeric($value) === true)) {
			ini_set($name, $value);	
		}
		return $this->getController();
    }
	private function mappingValue($value = NULL) {
		if ($value !== NULL && is_string($value) === true) {
			$replacement = array('on' => 1, 'off' => 0);
			$value = trim($value);
			foreach ($replacement as $name => $replaceValue) {
				if (preg_match('/^'.$name.'$/i', $value)) {
					$value = $replaceValue;
				}
			}
		}
		return $value;
	}
	private function mappingName($name = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			return trim($name);
		}
		return $name;
	}
}
