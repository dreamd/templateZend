<?php

namespace Dream\Application\Interfaces;

interface Singleton {
	static public function getApplication();
	static public function init();
}
?>