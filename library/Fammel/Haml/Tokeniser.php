<?php

namespace Fammel\Haml;

use Fammel\Haml\Token;

class Tokeniser {
	protected $_input;
	protected $_pos;
	protected $_line;
	protected $_column;
	protected $_just_escaped;
  
	public function __construct($input) {
		$this->_input = rtrim($input) . "\n";
		$this->_line = 1;
		$this->_pos = 0;
		$this->_column = 0;
		$this->_just_escaped = false;
	}

	public function input() {
		return $this->_input;
	}

	public function line() {
		return $this->_line;
	}
	public function column() {
		return $this->_column;
	}
	public function get_all_tokens() {
		$tokens = array();
		while($token = $this->get_token()) {
			$tokens[] = $token;
		}
		return $tokens;
	}
	public function get_token() {
		$token = null;
		$c = $this->get_char();
		if(!$c) {
			return null;
		}

		$start_column = $this->_column;

		if($this->_just_escaped) {
			$this->_just_escaped = false;
			return new Token('LINE_CONTENT', $this->get_line($c));
		}
		switch($c) {
			case "" : {
				$token = new Token('EOF');
				break;
			}
			case "\n" : {
				$token = new Token('INDENT', $this->get_indent());
				 break;
			}
			case '\\':
				$token = new Token('ESCAPE');
				$this->_just_escaped = true;
				break;
			case ' ' : {
				$token = $this->get_token();
				break;
			}
			case '%' : {
				$token = new Token('TAG', $this->get_tag_name());
				$this->skip_whitespace();
				break;
			}
			case '#' : {
				$token = new Token('ID', $this->get_name());
				$this->skip_whitespace();
				break;
			}
			case '.' : {
				$token = new Token('CLASS', $this->get_name());
				$this->skip_whitespace();
				break;
			}
			case '-' : {
				$c = $this->get_char();
				if($c == '#') {
					$token = new Token('HAML_COMMENT'); $this->skip_whitespace();
				} else {
					$this->rewind();
					$token = new Token('EXEC'); $this->skip_whitespace(); 
				}
				break;
			}
			case '/' : {
				$token = new Token('COMMENT');
				$this->skip_whitespace();
				break;
			}
			case '&' : {
				$c = $this->get_char();
				if($c == '=') {
					$token = new Token('ESCAPED_ECHO');
				} else {
					$this->rewind();
					$token = new Token('LINE_CONTENT', $this->get_line('&'));
				}
				break;
			}
			case '=' : {
				$c = $this->get_char();
				if($c == '>') {
					$this->skip_whitespace();
					$c = $this->get_char(); 
					if($c == '"') {
						$token = new Token('ATTR_VALUE', $this->get_attr_value(''));
					} else {
						$token = new Token('LINE_CONTENT', $this->get_line($c));
					}
				} else {
					$this->rewind();
					$token = new Token('PLAIN_ECHO'); 
				}
				$this->skip_whitespace();        
				break;
			}
			case ':' : {
				$token =  new Token('ATTR_NAME', $this->get_attr_name());
				break;
			}
			case '!' : {
				$c = $this->get_char();
				if($c == '=') {
					$token = new Token('UNESCAPED_ECHO');
				} else {
					$this->rewind();
					$doctype = $this->get_doctype('!');
					if($doctype == '!!!') {
						$token = new Token('DOCTYPE'); break;
					} else {
						$token = new Token('LINE_CONTENT', $this->get_line($doctype)); break;
					}
				}
				break;
			}
			case '{' : {
				$token = new Token('ATTR_START');
				$this->skip_whitespace();
				break;
			}
			case ',' : {
				$token = new Token('ATTR_SEP');
				$this->skip_whitespace();
				break;}
			case '}' : {
				$token = new Token('ATTR_END');
				$this->skip_whitespace();
				break;
			}
			default : {
				$token = new Token('LINE_CONTENT', $this->get_line($c));
				break;
			}
		}
		if($token) {
			$token->set_position($this->_line, $start_column);
		}
		return $token;
	}
	public function get_char() {
		$c = isset($this->_input[$this->_pos]) === true ? $this->_input[$this->_pos] : '';
		if($c == "\n") {
			$this->_line++;
			$this->_column = 0;
		}
		$this->_column++;
		$this->_pos++;
		return $c;
	}
	public function rewind() {
		if(!$this->_pos) {
			return;
		}
		$this->_pos--;
		if(isset($this->_input[$this->_pos]) === true && $this->_input[$this->_pos] == "\n") {
			$this->_line--;
			$this->_column = 1;
			for($pos = $this->_pos-1; $pos--; $this->_input[$pos] != "\n" && $pos >= 0) {
				$this->_column++;
			}
		} else {
			$this->_column--;
		}
	}
	public function skip_whitespace() {
		do {
			$c = $this->get_char();
		} while($c == ' ');
		$this->rewind();
	}
	public function get_name($c = '') {
		$token = '';
		do {
			$token = $token . $c;
		} while(strlen($c = $this->get_char()) && preg_match('/^[0-9a-zA-Z_-]+$/', $c));  

		$this->rewind();
		return $token;
	}
	public function get_tag_name($c = '') {
		$token = '';
		do {
			$token = $token . $c;
		} while(strlen($c = $this->get_char()) && preg_match('/^[a-zA-Z0-9:_-]+$/', $c));  
		$this->rewind();
		return $token;
	}
	public function get_line($c) {
		$token = '';
		do {
			$token = "$token$c";
		} while(strlen($c = $this->get_char()) && $c != "\n");
		$this->rewind();
		return $token;
	}
	public function get_doctype($c) {
		$token = '';
		do {
			$token = "$token$c";
		} while(strlen($c = $this->get_char()) && $c == "!");
		$this->rewind();
		return $token;
	}
	public function get_indent() {
		$token = '';
		while(strlen($c = $this->get_char()) && $c == ' ') {
			$token = "$token$c";
		}
		$this->rewind();
		return strlen($token);
	}
	public function get_attr_value($c) {
		$token = '';
		do {
			$token = "$token$c";
		} while(strlen($c = $this->get_char()) && $c != '"');
		return $token;
	}
	public function get_attr_name() {
		$token = '';
		do {
			$token = $token . $c;
		} while(strlen($c = $this->get_char()) && preg_match('/^[a-zA-Z:-]+$/', $c));  
		$this->rewind();
		return $token;
	}
}
?>
