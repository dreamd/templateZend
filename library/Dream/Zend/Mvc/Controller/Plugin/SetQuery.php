<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetQuery extends AbstractPlugin {
    public function __invoke($names = NULL, $value = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		
		if (empty($names) !== true && is_array($names) === true) {
			$querys = $this->getController()->getRequest()->getQuery()->toArray();
			$tempQuerys = &$querys;
			for ($i = 0; $i < count($names); $i++) {
				if ($i === count($names) - 1) {
					$tempQuerys[$names[$i]]	 = $value;
				} else {
					if (isset($tempQuerys[$names[$i]]) === false) {
						$tempQuerys[$names[$i]] = array();
					}
					$tempQuerys = &$tempQuerys[$names[$i]];
				}
			}
			$this->getController()->getRequest()->setQuery(new Parameters($querys));
		}
		return $this->getController();
    }
}
