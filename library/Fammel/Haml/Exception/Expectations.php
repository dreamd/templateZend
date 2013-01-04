<?php

namespace Fammel\Haml\Exception;

use Fammel\Haml\Exception\IndentException;

class Expectations {
	public $indent_size;
	protected $_got_indent_size;
	protected $_last_indent;
  
	public function __construct() {
		global $indent_size;
	
		$this->_got_indent_size = false;
		$this->indent_size = $indent_size = 2;
		$this->_last_indent = 0;
	}
	public function check($rule) {
		global $LINE;
		if($rule->indent && !$this->_got_indent_size) {
			global $indent_size;
			$indent_size = $this->indent_size = $rule->indent;
			$this->_got_indent_size = true;
		}
		if($this->_got_indent_size) {
			if($rule->indent % $this->indent_size != 0) {
				throw new IndentException("Parse error: indent ($rule->indent) is not a multiple of the current indent size ($this->indent_size) on or near line " . ($LINE -1), $LINE-1);
			}
			if($rule->indent > $this->_last_indent + $this->indent_size) {
				throw new IndentException("Parse error: indent is too large on or near line " . ($LINE -1), $LINE-1);
			}
			$this->_last_indent = $rule->indent; 
		}
	}
}
?>
