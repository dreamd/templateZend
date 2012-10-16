<?php

namespace Application\Controller;

use Application\Controller\BaseController;
function abc() {
	return 'a';	
}
class MainController extends BaseController {
	public function indexAction() {
		//$b =  __DIR__.DIRECTORY_SEPARATOR.'php_browscap.ini';
		//var_dump($b);
		//var_dump($this->setIni('browscap', $b));
		//print_r(get_browser(null));
		var_dump($this->getBrowser('browser', 'UNKNOWN'));
		var_dump($this->getCookie());
		print '<br /><br /><br /><br /><br /><br />';
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
