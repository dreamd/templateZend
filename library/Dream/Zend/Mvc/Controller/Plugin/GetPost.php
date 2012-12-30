<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetPost extends AbstractPlugin {
    public function __invoke($names = NULL, $default = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		$posts = $this->getController()->getRequest()->getPost()->toArray();
		
		if (empty($names) !== true && is_array($names) === true) {
			for ($i = 0; $i < count($names); $i++) {
				if (isset($posts[$names[$i]]) === true) {
					$posts = $posts[$names[$i]];
				} else {
					return $default;
				}
			}
		}
		return $posts;
    }
}
