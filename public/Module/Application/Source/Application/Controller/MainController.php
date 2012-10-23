<?php

namespace Application\Controller;

use Application\Controller\BaseController;

class MainController extends BaseController {
	public function indexAction() {
		$this->assign(array('id' => 'sfgfdgfdgfdg'));
		$this->showSubMenu();
    }
}
