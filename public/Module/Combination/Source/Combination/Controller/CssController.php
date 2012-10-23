<?php

namespace Combination\Controller;

use Combination\Controller\BaseController;

class CssController extends BaseController {
	public function dispatchLayout() {
		$this->setHeader('Content-type', 'text/css');
	}
	public function minAction() {
		$this->assign(array('name' => $this->getParam('name')));	
	}
}
