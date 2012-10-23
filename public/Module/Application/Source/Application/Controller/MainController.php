<?php

namespace Application\Controller;

use Application\Controller\BaseController;

class MainController extends BaseController {
	public function indexAction() {
		$this->result(array('id' => 'sfgfdgfdgfdg'));
		$this->showSubMenu();
    }
	public function addAction() {
		$this->setCookie(array('test1', 'ccc'), 'value', time() + 3600, '127.0.0.1', $this->basePath().'/');
		$this->setCookie(array('test2', 'ccc'), 'value', time() + 3600, '127.0.0.1', $this->basePath().'/'.$this->controllerName().'/');
		print '<br /><br /><br /><br /><br /><br />';
		$this->result(array('id' => 'sfgfdgfdgfdg'));
		$this->showSubMenu();
    }
}
