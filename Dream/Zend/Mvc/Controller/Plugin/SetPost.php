<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetPost extends AbstractPlugin {
    public function __invoke($names = NULL, $value = NULL) {
		$names = is_string($names) === true ? array($names) : $names;
		
		if (empty($names) !== true && is_array($names) === true) {
			$posts = $this->getController()->getRequest()->getPost()->toArray();
			$tempPosts = &$posts;
			for ($i = 0; $i < count($names); $i++) {
				if ($i === count($names) - 1) {
					$tempPosts[$names[$i]]	 = $value;
				} else {
					if (isset($tempPosts[$names[$i]]) === false) {
						$tempPosts[$names[$i]]	 = array();
					}
					$tempPosts = &$tempPosts[$names[$i]];
				}
			}
			$this->getController()->getRequest()->setPost(new Parameters($posts));
		}
		return $this->getController();
    }
}
