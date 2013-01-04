<?php

namespace Fammel\Haml;

class Token {
	protected $_type;
	protected $_value;
	protected $_line;
	protected $_column;
	
	public function __construct($type, $value = '') {
		$this->_type = $type;
		$this->_value = trim($value);
	}
	public function set_position($line, $column) {
		$this->_line = $line;
		$this->_column = $column;
	}
	public function type() {
		return $this->_type;
	}
	public function value() {
		return $this->_value;
	}
	public function line() {
		return $this->_line;
	}
	public function column() {
		return $this->_column;
	}
}
?>
