<?php

namespace ShareResources\Controller\Exception;

use \Exception;

class ControllerException extends Exception {
	public function setFile($file = NULL) {
		if (is_string($file) === false) {
			return;
		}
		$this->file = $file;	
	}
	public function setLine($line = NULL) {
		if (is_int($line) === false) {
			return;	
		}
		$this->line = $line;
	}
}