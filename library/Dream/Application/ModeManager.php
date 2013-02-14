<?php

namespace Dream\Application;

use Dream\Application\Interfaces\ModeOption;

class ModeManager implements ModeOption {
	const productModeKey = 'PRODUCTION', developmentModeKey = 'DEVELOPMENT';
	static public function productMode() {
		error_reporting(0);
		ini_set('display_errors', false);
	}
	static public function developmentMode() {
		error_reporting(-1);
		ini_set('display_errors', true);
		ini_set('display_startup_errors', true);
	}
}
?>