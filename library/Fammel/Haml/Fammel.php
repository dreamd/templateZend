<?php

namespace Fammel\Haml;

use Fammel\Haml\Haml, Fammel\Haml\Tokeniser;
use Fammel\Haml\Lime\ParseEngine;
use Fammel\Haml\Exception\ParseException;

class Fammel {
	protected $_haml;
	protected $_line;
	protected $_file;
	
	public function __construct() {
		$this->_haml = new Haml();
		$this->_file = null;
	}
	public function render() {
		return $this->_haml->render();
	}
	public function print_ast() {
		$this->_haml->print_ast();
	}
	public function line() {
		return $this->_line;
	}
	public function parse_file($file) {
		$this->_file = $file;
		return $this->parse(file_get_contents($file));
	}
	public function parse($input) {
		try {
			global $LINE;
			$tok = new Tokeniser($input);
			$parser = new ParseEngine($this->_haml);
			$parser->reset();
			$tokens = $tok->get_all_tokens();
			$tokens = array_merge(array(new Token('INDENT', 0)), $tokens);
			foreach($tokens as $t) {
				$LINE = $this->_line = $t->line();
				$parser->eat($t->type(), $t->value());
			}
			$parser->eat_eof();
			return true;
		} catch(parse_error $e) {
			$token = $value = '';
			preg_match('/\((.*?)\)\((.*?)\)/', $e->getMessage(), $matches);
			if($matches) {
				$token = $matches[1];
				$value = $matches[2];
				$message = "Parse error: unexpected $token ('$value')";
			} else {
				$message = $e->getMessage();
			}
			$message .= " at line $this->_line";
			if($this->_file) {
				$message .= " in $this->_file";
			}
			$message .= "\n";
			throw new ParseException($message, $this->_line, $token, $value);
		}
	}
}
?>
