<?php

namespace Fammel\Haml\Lime;

use Fammel\Haml\Lime\ParseStack, Fammel\Haml\Lime\Exception\ParseBug, Fammel\Haml\Lime\Exception\ParsePrematureEof;

class ParseEngine {
	public function __construct($parser) {
		$this->parser = $parser;
		$this->qi = $parser->qi;
		$this->rule = $parser->a;
		$this->step = $parser->i;
		$this->reset();
	}
	public function reset() {
		$this->accept = false;
		$this->stack = new ParseStack($this->qi);
	}
	private function enter_error_tolerant_state() {
		while ($this->stack->occupied()) {
			if ($this->has_step_for('error')) return true;
			$this->drop();
		};
		return false;
	}
	private function drop() {
		$this->stack->pop_n(1);
	}
	public function eat_eof() {
		do {
			list($opcode, $operand) = $this->step_for('#');
			switch ($opcode) {
				case 'r': $this->reduce($operand); break;
				case 'e': $this->premature_eof(); break;
				default: throw new ParseBug(); break;
			}
		} while ($this->stack->occupied());
		
		if (!$this->accept) {
			throw new ParseBug();
		}
		return $this->semantic;
	}
	private function premature_eof() {
		$seen = array();
		while ($this->enter_error_tolerant_state()) {
			if (isset($seen[$this->state()])) {
				$this->drop();
				continue;
			}
			$seen[$this->state()] = true;
			$this->eat('error', NULL);
			if ($this->has_step_for('#')) {
				return;
			} 
		}
		throw new ParsePrematureEof();
	}
	private function current_row() {
		return $this->step[$this->state()];
	}
	private function step_for($type) {
		$row = $this->current_row();
		if (!isset($row[$type])) {
			return array('e', $this->stack->q);
		}
		return explode(' ', $row[$type]);
	}
	private function has_step_for($type) {
		$row = $this->current_row();
		return isset($row[$type]);
	}
	private function state() {
		return $this->stack->q;
	}
	public function eat($type, $semantic) {
		list($opcode, $operand) = $this->step_for($type);
		switch ($opcode) {
			case 's': {
				$this->stack->shift($operand, $semantic);
				break;
			}
			case 'r' : {
				$this->reduce($operand);
				$this->eat($type, $semantic);
				break;
			}
			case 'a' : {
				if ($this->stack->occupied()) {
					throw new ParseBug('Accept should happen with empty stack.');
				}
				$this->accept = true;
				$this->semantic = $semantic;
				break;
			}
			case 'e' : {
				if ($this->enter_error_tolerant_state()) {
					$this->eat('error', NULL);
					if ($this->has_step_for($type)) $this->eat($type, $semantic);
				} else {
					throw new ParseError("Parse Error: ($type)($semantic) not expected");
				}
				break;
			}
			default : {
				throw new ParseBug("Bad parse table instruction ".htmlspecialchars($opcode));
			}
		}
	}
	private function reduce($rule_id) {
		$rule = $this->rule[$rule_id];
		$len = $rule['len'];
		$semantic = $this->perform_action($rule_id, $this->stack->top_n($len));
		if ($rule['replace']) {
			$this->stack->pop_n($len);
		} else {
			$this->stack->index($len);
		}
		$this->eat($rule['symbol'], $semantic);
	}
	private function perform_action($rule_id, $slice) {
		$result = null;
		$method = $this->parser->method[$rule_id];
		$this->parser->$method($slice, $result);
		return $result;
	}
}
