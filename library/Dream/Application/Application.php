<?php

namespace Dream\Application;

use \stdClass, Dream\Application\ModeManager;
use Dream\Application\Interfaces\Singleton, Dream\Application\Interfaces\Service;

class Application implements Singleton, Service {
	protected $project = NULL, $mode = NULL, $config = array();
	public function __construct() {
		$trace = debug_backtrace();
		$this->setConfig(func_get_args())->setProject($trace[1])->setMode()->setTimeZone()->setLog();
	}
	public function setTimeZone() {
		if (isset($this->config['time_zone']) === false || is_string($this->config['time_zone']) === false) {
			return $this;
		}
		date_default_timezone_set($this->config['time_zone']);
		return $this;
	}
	public function setLog() {
		if (isset($this->config['error_log']) === false || is_bool($this->config['error_log']) === false) {
			return $this;
		}
		if ($this->config['error_log'] === true) {
			ini_set('log_errors', true);
			ini_set('error_log', getcwd().'/'.$this->project.'_'.date('YmdHis').'_errorlog.log');
			set_time_limit(0);
			ignore_user_abort(true);
		}
		return $this;
	}
	public function setConfig() {
		$config = func_get_args();
		while (isset($config[0]) === true) {
			$config = $config[0];
		}
		$this->config = $config;
		return $this;
	}
	public function getConfig() {
		return $this->config;	
	}
	public function setMode() {
		if (isset($this->config['mode']) === false || is_string($this->config['mode']) === false) {
			return $this;
		}
		switch (strtoupper($this->config['mode'])) {
			case ModeManager::developmentModeKey : {
				$this->mode = ModeManager::developmentModeKey;
				ModeManager::developmentMode();
				break;
			}
			default : {
				$this->mode = ModeManager::productModeKey;
				ModeManager::productMode();
				break;
			}
		}
		return $this;
	}
	public function getMode() {
		return $this->mode;	
	}
	public function setProject() {
		if (func_num_args() === 0) {
			return $this;	
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