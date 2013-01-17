<?php

namespace Dream\Application\Interfaces;

use \stdClass;

interface Service {
	public function setMode();
	public function getMode();
	public function setProject();
	public function getProject();
}
?>