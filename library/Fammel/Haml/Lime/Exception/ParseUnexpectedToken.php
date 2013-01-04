<?php

namespace Fammel\Haml\Lime\Exception;

use Fammel\Haml\Lime\Exception\ParseError;

class ParseUnexpectedToken extends ParseError {
	public function __construct($type, $state) {
		parent::__construct("Unexpected token of type ($type)");
		$this->type = $type;
		$this->state = $state;
	}
}
?>
