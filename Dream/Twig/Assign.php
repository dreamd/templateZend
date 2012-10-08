<?php

namespace Dream\Twig;

class Assign {
	public $assign;
	public function __set($property = NULL, $value = NULL) {
		if ($property !== NULL && $value !== NULL) {
			if (isset($this->assign[$property]) === true) {
					$this->assign[$property] = array_merge($this->assign[$property], (array)$value);
			} else {
				$this->assign[$property] = $value;	
			}
		}
		return $this;
	}
	public function __get($property = NULL) {
		if ($property !== NULL && isset($this->assign[$property]) === true) {
			return $this->assign[$property];	
		}
		return NULL;
	}
	public function __isset($property = NULL) {
		if ($property !== NULL) {
			return isset($this->assign[$property]) === true;
		}
		return false;
	}
	public function __unset($property = NULL) {
		if ($property !== NULL && isset($this->assign[$property]) === true) {
			unset($this->assign[$property]);
		}
		return $this;	
	}
}