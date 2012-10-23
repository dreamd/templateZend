<?php

namespace Combination\Controller;

use Combination\Controller\BaseController;

class JqueryController extends BaseController {
	public function dispatchLayout() {
		$this->setHeader('Content-type', 'text/javascript');
	}
	public function minAction() {
		$this->assign(array('name' => $this->getParam('name')));	
	}
}
