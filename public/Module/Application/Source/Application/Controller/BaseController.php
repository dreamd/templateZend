<?php

namespace Application\Controller;

use Dream\Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController {
	public function dispatchLayout() {
		$this->assign(array('id2'=> 'dfsdfdsfsd'));
	}
	protected function showSubMenu() {
		$this->assign(array(
		
		));	
	}
}
