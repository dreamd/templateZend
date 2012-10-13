<?php

namespace Application\Controller;

use Application\Controller\BaseController;

class MainController extends BaseController {
	public function indexAction() {
		var_dump($this->getFiles('file', 'NULL'));
		
		print '<br /><br /><br /><br /><br /><br />';
		$this->result(array('id' => 'sfgfdgfdgfdg'));
		$this->showSubMenu();
    }
}
