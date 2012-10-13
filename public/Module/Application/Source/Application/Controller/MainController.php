<?php

namespace Application\Controller;

use Application\Controller\BaseController;

class MainController extends BaseController {
	public function indexAction() {
		$this->setFiles(array('a', 'bb','cc'), 'cccc');
		var_dump($this->getFiles(array('a'), 'NULL'));
		print '<br /><br /><br /><br /><br /><br />';
		$this->result(array('id' => 'sfgfdgfdgfdg'));
		$this->showSubMenu();
    }
}
