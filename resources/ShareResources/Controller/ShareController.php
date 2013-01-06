<?php
namespace ShareResources\Controller;

use Dream\Zend\Mvc\Controller\AbstractActionController;
use ShareResources\Controller\Exception\ControllerException;

class ShareController extends AbstractActionController {
	private $storage = array();
	public function throwException($message = NULL) {
		$message = is_string($message) === false ? 'Error' : $message;	
		$trace = debug_backtrace();
		$caller = (object)array_shift($trace);
		$controllerException = new ControllerException($message);
		$controllerException->setFile($caller->file);
		$controllerException->setLine($caller->line);
		
		throw $controllerException;		
	}
	public function __get($name = NULL) {
		if (is_string($name) === true && isset($this->storage[$name]) === true) {
			return $this->storage[$name];
		}
		return NULL;
	}
	public function __set($name = NULL, $value = NULL) {
		if (is_string($name) === true) {
			$this->storage[$name] = $value;	
		}
	}
	public function __isset($name = NULL) {
		return isset($this->storage[$name]);
	}
	public function __unset($name) {
		if (isset($this->storage[$name]) === true) {
			unset($this->storage[$name]);	
		}
	}
}
