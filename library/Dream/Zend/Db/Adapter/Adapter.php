<?php

namespace Dream\Zend\Db\Adapter;

use Zend\Db\Adapter\Adapter AS ZendAdapter;
use ResultSet\ResultSetInterface, Platform\PlatformInterface;

class Adapter extends ZendAdapter {
	protected $haveSetup = false;
	public function __construct($driver = NULL, PlatformInterface $platform = NULL, ResultSetInterface $queryResultPrototype = NULL) {
		if (is_null($driver) === false) {
			$this->haveSetup = true;
			parent::__construct($driver, $platform, $queryResultPrototype);
		}
	}
	public function setup($driver = NULL, PlatformInterface $platform = NULL, ResultSetInterface $queryResultPrototype = NULL) {
		if ($this->haveSetup === false) {
			parent::__construct($driver, $platform, $queryResultPrototype);
		}
	}
}