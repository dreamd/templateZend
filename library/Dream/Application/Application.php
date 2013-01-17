<?php

namespace Dream\Application;

use \stdClass, Dream\Application\ModeManager;
use Dream\Application\Interfaces\Singleton, Dream\Application\Interfaces\Service;

class Application implements Singleton, Service {
	protected $project = NULL, $mode = NULL;
	const productModeKey = 'PRODUCTION', developmentModeKey = 'DEVELOPMENT';
	public function __construct() {
		$trace = debug_backtrace();
		$this->setProject($trace[1])->setMode(func_get_args());
	}
	public function setMode() {
		if (func_num_args() === 0) {
			return;
		}
		$applicationConfig = func_get_arg(0);
		if (isset($applicationConfig['mode']) === false || is_string($applicationConfig['mode']) === false) {
			return;
		}
		switch (strtoupper($applicationConfig['mode'])) {
			case self::productModeKey : {
				$this->mode = self::productModeKey;
				ModeManager::productMode();
			}
			case self::developmentModeKey : {
				$this->mode = self::developmentModeKey;
				ModeManager::developmentMode();
			}
		}
		return $this;
	}
	public function getMode() {
		return $this->mode;	
	}
	public function setProject() {
		if (func_num_args() === 0) {
			return;	
		}
		if (isset(func_get_arg(0)->file) === true) {
			$this->project = basename(dirname(dirname(func_get_arg(0)->file)));
		}
		return $this;
	}
	public function getProject() {
		return $this->project;	
	}
	
	static public function getApplication() {
		return 	$GLOBALS['application'];
	}
	static public function init() {
		$GLOBALS['application'] = new self(func_get_args());
		call_user_func_array(array('Zend\Mvc\Application', 'init'), func_get_args())->run();
	}
}
?>