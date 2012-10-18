<?php

namespace Application\Controller;

use Application\Controller\BaseController;
function abc() {
	return 'a';	
}
class MainController extends BaseController {
	public function indexAction() {
		print 'cssversion'.'->';var_dump($this->cssVersion());print '<br />';
		print 'ismobile'.'->';var_dump($this->ismobile());print '<br />';
		print 'isandroid'.'->';var_dump($this->isandroid());print '<br />';
		print 'ismac'.'->';var_dump($this->ismac());print '<br />';
		print 'isios'.'->';var_dump($this->isios());print '<br />';
		print 'isipad'.'->';var_dump($this->isipad());print '<br />';
		print 'isiphone'.'->';var_dump($this->isiphone());print '<br />';
		print 'isipod'.'->';var_dump($this->isipod());print '<br />';
		print 'islinux'.'->';var_dump($this->islinux());print '<br />';
		print 'iswinxp'.'->';var_dump($this->iswinxp());print '<br />';
		print 'iswinvista'.'->';var_dump($this->iswinvista());print '<br />';
		print 'iswin7'.'->';var_dump($this->iswin7());print '<br />';
		print 'iswin8'.'->';var_dump($this->iswin8());print '<br />';
		print 'iswin16'.'->';var_dump($this->iswin16());print '<br />';
		print 'iswin32'.'->';var_dump($this->iswin32());print '<br />';

		print 'iswin64'.'->';var_dump($this->iswin64());print '<br />';
		print 'ischrome'.'->';var_dump($this->ischrome());print '<br />';
		print 'isie'.'->';var_dump($this->isie());print '<br />';
		print 'isfirefox'.'->';var_dump($this->isfirefox());print '<br />';
		print 'issafari'.'->';var_dump($this->issafari());print '<br />';
		print 'cancookies'.'->';var_dump($this->cancookies());print '<br />';

		print 'canjavascript'.'->';var_dump($this->canjavascript());print '<br />';
		print 'canjavaapplets'.'->';var_dump($this->canjavaapplets());print '<br />';
		print 'canvbscript'.'->';var_dump($this->canvbscript());print '<br />';
		print 'canbgsounds'.'->';var_dump($this->canbgsounds());print '<br />';
		print 'caniframes'.'->';var_dump($this->caniframes());print '<br />';
		print 'canframes'.'->';var_dump($this->canframes());print '<br />';
		print 'cantables'.'->';var_dump($this->cantables());print '<br />';

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
