<?php

namespace Fammel\Haml;

use Fammel\Haml\Lime\LimeParser, Fammel\Haml\HamlRule;
use Fammel\Haml\Exception\Expectations;

class HamlParser extends LimeParser {
	protected $_ast;
	protected $_last_rule;
	
	protected $_cur_attr;
	protected $_cur_tag;
	
	protected $_expect;
	
	public function __construct() {
		$this->_cur_attr = $this->_last_parent = array();
		$this->_cur_tag = '';
		$this->_ast[0] = $this->_last_rule = new HamlRule(0, '', array(), HamlRule::ROOT, '');
		array_unshift($this->_last_parent, $this->_last_rule);
		$this->_expect = new Expectations();
	}
	public function add_rule($indent, $tag, $attr, $action, $content) {
		$new_rule = new HamlRule($indent, $tag, $attr, $action, $content);
		$new_rule->index = count($this->_ast);
		$this->_expect->check($new_rule);
		$this->_ast[] = $new_rule;
		$this->_last_rule->next = $new_rule;
		$new_rule->prev = $this->_last_rule;
		if($new_rule->indent > $this->_last_rule->indent) {
			array_unshift($this->_last_parent, $this->_last_rule);
		} else if($new_rule->indent < $this->_last_rule->indent) {
			$last_indent = $this->_last_rule->indent;
			for(;$last_indent > $indent; $last_indent -= 2) {
				$popped = array_shift($this->_last_parent);
			}
			$new_rule->prev_sibling = $popped;
			$popped->next_sibling = $new_rule;
		} else {
			$new_rule->next_sibling = $new_rule->next;
			$new_rule->prev_sibling = $new_rule->prev;
		}
		$this->_last_parent[0]->children[] = $new_rule;
		$new_rule->parent = $this->_last_parent[0];
		$this->_last_rule = $new_rule;
		$this->_cur_tag = '';
		$this->_cur_attr = array();
	}
	public function process_tag($tag, $id) {
		$this->_cur_tag = $tag;
		if($id) {
			$this->_cur_attr['id'] = $id;
		}
	} 
	public function process_attr($name, $value) {
		$this->_cur_attr[$name] = $value;
	}
	public function process_content_rule($indent, $content) {
		$this->add_rule($indent, $this->_cur_tag, $this->_cur_attr, HamlRule::CONTENT, $content);
	}
	public function process_comment_rule($indent, $content) {
		$this->add_rule($indent, '', array(), HamlRule::COMMENT, $content);
	}
	public function process_echo_rule($indent, $code, $escaping) {    
		switch($escaping) {
			case 'PLAIN_ECHO' : {
			}
			case 'ESCAPED_ECHO' : {
				$code = "htmlentities($code, ENT_COMPAT);";
				break;
			}
		}
		$this->add_rule($indent, $this->_cur_tag, $this->_cur_attr, HamlRule::EXEC_ECHO, $code);
	}
	public function process_exec_rule($indent, $code) {
		$this->add_rule($indent, $this->_cur_tag, $this->_cur_attr, HamlRule::EXEC, $code);
	}
	public function process_doctype($doctype) {
		$this->add_rule(0, '', array(), HamlRule::DOCTYPE, $doctype);
	}
	public function process_class($class) {
		if(isset($this->_cur_attr['class'])) {
			$this->_cur_attr['class'] .= " $class";
		} else {
			$this->_cur_attr['class'] = "$class";
		}
	}
	public function print_ast() {
		foreach($this->_ast as $rule) {
			printf("%3.3d\tp=%3.3d,c=%3.3d,n=%3.3d,v=%3.3d\t", $rule->index, $rule->parent->index, $rule->child->index, $rule->next->index, $rule->prev->index); 
			for($i = 0; $i < $rule->indent; $i++) {
				echo " ";
			}
			echo "$rule->tag(";
			foreach($rule->attr as $attr => $value) {
				echo "$attr: $value ";
			}
			echo ") $rule->action: $rule->content\n";
		}
	}
	public function render() {
		$this->_rendered = $this->_ast[0]->render();
		return $this->_rendered;
	}
}
?>
