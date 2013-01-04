<?php

namespace Fammel\Haml\Exception;
	
use \Exception;

class IndentExecption extends Exception {
	public $line;
	
	public function __construct($message, $line) {
		parent::__construct($message);
		$this->line = $line;
	}
}
?>