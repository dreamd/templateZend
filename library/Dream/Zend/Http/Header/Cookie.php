<?php

namespace Dream\Zend\Http\Header;

use Zend\Http\Header\Cookie as ZendCookie;

class Cookie extends ZendCookie {
    public function getFieldValue() {
        $nvPairs = array();
		$names = array();
		$this->toArrayCookieLine($names, $this, $nvPairs);	
        return implode('; ', $nvPairs);
    }
	private function toArrayCookieLine(array &$names = array(), $baseValue, array &$nvPairs = array()) {
		foreach ($baseValue as $name => $value) {
			if (is_array($value) === true) {
				$newNames = $names;
				$newNames[] = $name;
				$this->toArrayCookieLine($newNames, $value, $nvPairs);
			} else {
				$newNames = $names;
				$newNames[] = $name;
				$nvPairs[] = $this->toArrayCookieName($newNames).'='.(($this->encodeValue) ? urlencode($value) : $value);
			}
		}
	}
	private function toArrayCookieName(array $names = array()) {
		$return = '';
		for ($i = 0; $i < count($names); $i++) {
			$return .= ($i > 0 ? '[' : '').$names[$i].($i > 0 ? ']' : '');
		}
		return $return;
	}
}
