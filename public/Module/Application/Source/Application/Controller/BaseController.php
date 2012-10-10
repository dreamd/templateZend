<?php

namespace Application\Controller;

use Dream\Zend\Mvc\Controller\AbstractActionController;

class BaseController extends AbstractActionController {
	public function dispatchLayout() {
		$this->assign->name = 'Hello';
		return array('id2'=> 'dfsdfdsfsd');
	}
}
