<?php

namespace Dream\Zend\Mvc\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin, Zend\Stdlib\Parameters;

class SetPost extends AbstractPlugin {
    public function __invoke($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL && is_string($name) === true) {
			$posts = $this->getController()->getRequest()->getPost();
			$posts->set($name, $value);
			$this->getController()->getRequest()->setPost($posts);
		}
		return $this->getController();
    }
}
