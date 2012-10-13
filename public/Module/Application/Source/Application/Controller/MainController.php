<?php

namespace Application\Controller;

use Application\Controller\BaseController;
/*
$this->getModulerName
$this->getControllerName
$this->getControllerFullName
$this->getActionName
$this->getRouteName
$this->isPost
$this->getPost
$this->setPost
$this->isGet
$this->getQuery
$this->setQuery
$this->getFiles
$this->setFiles
$this->getCookie
$this->getHeader
$this->setHeader
$this->isOptions
$this->isHead
$this->isPut
$this->isDelete
$this->isTrace
$this->isConnect
$this->isPatch
$this->isXmlHttpRequest
$this->isFlashRequest
$this->setStatusCode
*/

class MainController extends BaseController {
	public function indexAction() {
		var_dump($this->getFiles('file'));
  		print '<br /><br /><br /><br /><br /><br />';
		var_dump($this->getUri());
		$bb = $this->getUri();
		$this->setUri($bb);
		print $this->getMethod();
		$this->setMethod('POST');
		var_dump($this->getUrl());
		print $this->url()->fromRoute('home', array()).'_<br />';
		print $this->moduleName().'_<br />';
		print $this->controllerName().'_<br />';
		print $this->controllerFullName().'_<br />';
		print $this->actionName().'_<br />';
		print $this->routeName().'_<br />';
		var_dump($this->isPost());print '55_<br />';
		$this->setPost('name', 'bbb');
		var_dump($this->getPost('name', 'aaa'));
		var_dump($this->isGet());print '_<br />';
		$this->setQuery('name', 'ccc');
		var_dump($this->getQuery('name', '111'));
		
		$this->setFiles('name', '333');
		var_dump($this->getFiles('name'));print 'zzzzz<br />';
		var_dump($this->getFiles('file'));print 'zzzzz<br />';
		
		//var_dump($this->getCookies());
		$this->setHeader('aaa', 'test');
		var_dump($this->getHeader('aaa', 'none'));
		
		var_dump($this->isOptions());print '_<br />';
		var_dump($this->isHead());print '_<br />';
		var_dump($this->isPut());print '_<br />';
		var_dump($this->isDelete());print '_<br />';
		var_dump($this->isTrace());print '_<br />';
		var_dump($this->isConnect());print '_<br />';
		var_dump($this->isPatch());print '_<br />';
		var_dump($this->isXmlHttpRequest());print '_<br />';
		var_dump($this->isFlashRequest());print '_<br />';
		$this->setStatusCode(400);
		var_dump($this->getStatusCode());print '_<br />';
		$this->setParam('abc', 999);
		var_dump($this->getParam('abc', '888'));print '_<br />';
		//$this->redirectRoute('album');
		//$this->redirectUrl('http://www.google.com');
		var_dump($this->baseUrl('home'));
		//$foo = $this->forward()->dispatch('foo', array('action' => 'process'));
		print $this->escapeHtml('sxsss');
		print $this->translate('Home', 'tr_TR');
		$this->result(array('id' => 'sfgfdgfdgfdg'));
		$this->showSubMenu();
    }
}
