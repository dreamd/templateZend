<?php

namespace Fammel\Haml\Lime;

class ParseStack {
	public function __construct($qi) {
		$this->q = $qi;
		$this->qs = array();
		$this->ss = array();
	}
	public function shift($q, $semantic) {
		$this->ss[] = $semantic;
		$this->qs[] = $this->q;
		$this->q = $q;
	}
	public function top_n($n) {
		if (!$n) return array();
		return array_slice($this->ss, 0-$n);
	}
	public function pop_n($n) {
		if (!$n) return array();
		$qq = array_splice($this->qs, 0-$n);
		$this->q = $qq[0];
		return array_splice($this->ss, 0-$n);
	}
	public function occupied() {
		return !empty($this->ss);
	}
	public function index($n) {
		if ($n) {
			$this->q = $this->qs[count($this->qs)-$n];
		}
	}
	public function text() {
		return $this->q." : ".implode(' . ', array_reverse($this->qs));
	}
}
?>