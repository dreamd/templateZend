<?php

namespace Dream\Zend\Mvc\View;

use Dream\Zend\Mvc\View\Exception\ViewStorageException;

class ViewStorage {
	private $storage = array();
	public function __set($name = NULL, $value = NULL) {
		if (is_string($name) === false) {
			throw new ViewStorageException('Can not set key in view storage');	
		}
		$this->storage[$name] = $value;
	}
	public function __get($name = NULL) {
		if (is_string($name) === false || array_key_exists($name, $this->storage) === false) {
			throw new ViewStorageException('Can not get key in view storage');	
		}
		return $this->storage[$name];
	}
	public function __isset($name = NULL) {
		if (is_string($name) === false) {
			return false;
		}
		return isset($this->storage[$name]);
	}
	public function __unset($name = NULL) {
		if (is_string($name) === false) {
			return;	
		}
		unset($this->storage[$name]);
	}
	public function values() {
		return $this->storage;
	}
}
