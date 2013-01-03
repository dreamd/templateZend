<?php
namespace Dream\Zend\View\Model;

use Zend\View\Model\ViewModel as ZendViewModel;

class ViewModel extends ZendViewModel {
			protected $useTwig = true;
			protected $outputFormat = 'HTML';
			protected $allowFormats = array(
					'HTML', 'HAML', 'JADE',
			);
			public function setFormat($format = NULL) {

					if (is_string($format) !== true || in_array(strtoupper($format), $this->allowFormats) === false) {
							return;
					}
					$this->outputFormat = strtoupper($format);
			}
			public function useTwig() {
					return $this->useTwig;
			}
			public function currentFormat() {
					return $this->outputFormat;
			}
}
