<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class GetPost extends AbstractPlugin {
    public function __invoke($name = NULL, $default = NULL, array $option = array()) {
		if ($name !== NULL && is_string($name) === true) {
			$posts = $this->getController()->getRequest()->getPost($name, $default);
			if (is_array($posts) === true) {
				for ($i = 0; $i < count($option); $i++) {
					if (isset($posts[$option[$i]]) === true) {
						$posts = $posts[$option[$i]];
					} else {
						return $default;
					}
				}
			}
			return $posts;
		}
		return $default;
    }
}
