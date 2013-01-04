<?php

namespace Fammel\Haml\Lime\Exception;

use Fammel\Haml\Lime\Exception\ParseError;

class ParsePrematureEof extends ParseError {
	public function __construct() {
		parent::__construct("Premature EOF");
	}
}
?>
