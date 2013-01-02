<?php

namespace Application\Controller;

use Application\Controller\InternalController;
use \Exception;
class IndexController extends InternalController {
    public function indexAction() {
		$this->view->a = array('a' => 1, 'b' => 2);
    }
	public function testAction() {
		$this->throwException('test Exception');
	}
}
