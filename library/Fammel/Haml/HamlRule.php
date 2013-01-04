<?php

namespace Fammel\Haml;

class HamlRule {
	const CONTENT = 'content';
	const EXEC_ECHO = 'echo';
	const EXEC = 'exec';
	const ROOT = 'root';
	const COMMENT = 'comment';
	const DOCTYPE = 'doctype';
	public $indent;
	public $tag;
	public $attr;
	public $action;
	public $content;
	public $index;
	public $parent;
	public $children;
	public $next;
	public $prev;
	public $next_sibling;
	public $prev_sibling;  
  
	public function __construct($indent, $tag, $attr, $action, $content) {
		$this->indent = $indent;
		$this->tag = $tag;
		$this->attr = $attr;
		$this->action = $action;
		$this->content = trim($content);
		
		$this->parent = $this->next = $this->prev = null; 
		$this->index = 0;
		$this->children = array();
		
		if(isset($this->attr['class']) === true && count($this->attr['class'])) {
			$classes = explode(' ', $this->attr['class']);
			$classes = array_unique($classes);
			sort($classes);
			$this->attr['class'] = implode(' ', $classes);
		}
	}
	
	public function render() {
		global $indent_size;
		$indent = $rendered = '';
		if($this->action == HamlRule::DOCTYPE) {
			$this->content = trim(strtolower($this->content));
		
			if(preg_match('/^xml/', $this->content)) {
				$charset = trim(str_replace('xml', '', $this->content));
				if(!$charset) {
					$charset = 'utf-8';
				}
				$rendered .= "<?xml version='1.0' encoding='$charset' ?>\n";
			} else {
				switch($this->content) {
					default : {
					}
					case '5' : {
						$rendered .= '<!DOCTYPE html>';
						break;
					}
					case '1.0 transitional' : {
					$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">'; break;
					}
					case 'strict' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">'; break;
					}
					case 'frameset' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">'; break;
					}
					case '1.1' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">'; break;
					}
					case 'basic' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML Basic 1.1//EN" "http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">'; break; 
					}
					case 'mobile' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.2//EN" "http://www.openmobilealliance.org/tech/DTD/xhtml-mobile12.dtd">'; break;
					}
					case '4.01 transitional' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">'; break;
					}
					case '4.01 strict' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">'; break;
					}
					case '4.01 frameset' : {
						$rendered .= '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">'; break;
					}
				}
				$rendered .= "\n";
			}
			return $rendered;
		}
		for($i = 0; $i < $this->indent; $i++) {      
			$indent .= " ";
		}
		if($this->tag) {
			$rendered .= "$indent<$this->tag";
			if(count($this->attr)) {
				asort($this->attr);
				foreach($this->attr as $name => $value) {
					$rendered .= " $name=\"$value\"";
				}
			}
			$rendered .= ">\n";
		}
		if($this->tag && $this->content) {
			for($i = 0; $i < $indent_size; $i++) {      
				$rendered .= " ";
			}
		}
		switch($this->action) {
			case HamlRule::COMMENT : {
				$rendered .= "$indent<!-- $this->content";
				if($this->next->indent <= $this->indent) {
					$rendered .= " -->";
				} else {
					$rendered .= "\n";
				}
				break;
			}
			case HamlRule::CONTENT : {
				if($this->content) {
					$rendered .= "$indent$this->content";
				}
				break;
			}
			case HamlRule::EXEC_ECHO : {
				$rendered .= "$indent<?php echo $this->content ?>";
				break;
			}
			case HamlRule::EXEC : {
				if(!($this->prev_sibling->action == HamlRule::EXEC && $this->prev_sibling->next->indent > $this->prev_sibling->indent)) {
					$rendered .= "$indent<?php ";
				}
				$rendered .= "$this->content";
				if($this->next->indent > $this->indent) {
					$rendered .= " {";
				}
				$rendered .= " ?>";
				break;
			}
		}
		if($this->content || (!$this->content && !$this->tag)) {
			$rendered .= "\n";
		}
		foreach($this->children as $child) {
			$rendered .= $child->render();
		}
		if(@$this->next->indent > $this->indent) {
			switch($this->action) {
				case HamlRule::EXEC : {
					$rendered .= "$indent<?php } ";	
					if(!($this->next_sibling->action == HamlRule::EXEC && $this->next_sibling->next->indent > $this->next_sibling->indent)) {
						$rendered .= " ?>\n";
					}
					break;
				}
				case HamlRule::COMMENT : {
					$rendered .= "$indent-->\n";
					break;
				}
			}
		}
		if($this->tag) {
			$rendered .= "$indent</$this->tag>\n";
		}
		return $rendered;
	}
}
?>
