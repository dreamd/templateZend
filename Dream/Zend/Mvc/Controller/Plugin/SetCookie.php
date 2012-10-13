<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Http\Header\SetCookie as ZendSetCookie;

class SetCookie extends AbstractPlugin {
    public function __invoke(array $names = array(), $value = NULL, $expires = NULL, $domain = NULL, $path = NULL) {
		if (empty($names) !== true && $value !== NULL) {
			$header = new ZendSetCookie();
			$header->setName($this->toArrayCookieName($names));
			$header->setValue($value);
			if ($expires !== NULL) {
				$header->setExpires($expires);
			}
			if ($domain !== NULL) {
				$header->setDomain($domain);
			}
			if ($path !== NULL) {
				$header->setPath($path);
			}
			$this->getController()->getResponse()->getHeaders()->addHeader($header);
		}
		return $this->getController();
    }
	private function toArrayCookieName(array $names = array()) {
		$return = '';
		for ($i = 0; $i < count($names); $i++) {
			$return .= ($i > 0 ? '[' : '').$names[$i].($i > 0 ? ']' : '');
		}
		return $return;
	}
}
