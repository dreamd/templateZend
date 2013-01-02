<?php
namespace ShareResources\Controller;

use Dream\Zend\Mvc\Controller\AbstractActionController;
use ShareResources\Controller\Exception\ControllerException;

class ShareController extends AbstractActionController {
	public function throwException($message = NULL) {
		$message = is_string($message) === false ? 'Error' : $message;	
		$trace = debug_backtrace();
		$caller = (object)array_shift($trace);
		$controllerException = new ControllerException($message);
		$controllerException->setFile($caller->file);
		$controllerException->setLine($caller->line);
		
		throw $controllerException;		
	}
}
