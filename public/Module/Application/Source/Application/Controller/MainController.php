<?php

namespace Application\Controller;

use Dream\Zend\Mvc\Controller\AbstractActionController;
use Zend\I18n\Translator\Translator;
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

class MainController extends AbstractActionController {
	public function indexAction() {
		print $this->url()->fromRoute('home', array()).'_<br />';
		print $this->moduleName().'_<br />';
		print $this->controllerName().'_<br />';
		//$foo = $this->forward()->dispatch('foo', array('action' => 'process'));
		print 11;
		//print($this->url());
		//$url = $this->url()->fromRoute('route-name', array('aa' => 'aa'));
		//var_dump($url);
		//var_dump($this->translate('Home', 'tr_TR'));
		//print '444';
		/*
		var_dump($this->response->getContent());
		print 'xxx';
		var_dump($this->getControllerName());
		var_dump($this->getActionName());
		var_dump($this->getRouteName());
		var_dump($this->getControllerFullName());
		var_dump($this->getModulerName());
		print $this->getParam('id', 0);
		*/
		$this->assign->name = 'Hello';
		return array('id'=> 11);
    }
}
