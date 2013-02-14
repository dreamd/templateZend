<?php

namespace Dream\Application\Interfaces;

use \stdClass;

interface Service {
	public function setTimeZone();
	public function setLog();
	public function setConfig();
	public function getConfig();
	public function setMode();
	public function getMode();
	public function setProject();
	public function getProject();
}
?>