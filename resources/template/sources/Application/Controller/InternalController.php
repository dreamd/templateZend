<?php
namespace Application\Controller;

use ShareResources\Controller\ShareController;

class InternalController extends ShareController {
		public function dispatchLayout() {
				parent::dispatchLayout();
				$this->useTwig = true;
				$this->setFormat('JADE');
	}
}
