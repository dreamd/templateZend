<?php

namespace Dream\PhpBrowscap;

use phpbrowscap\Browscap as PhpBrowscap;

class Browscap extends PhpBrowscap {
	const defaultCacheFolder = 'cache';
	const defaultBrowscapIni = 'php_browscap.ini';
	public function __construct() {
		$this->localFile = __DIR__.DIRECTORY_SEPARATOR.self::defaultBrowscapIni;
		parent::__construct(__DIR__.DIRECTORY_SEPARATOR.self::defaultCacheFolder);	
	}
}