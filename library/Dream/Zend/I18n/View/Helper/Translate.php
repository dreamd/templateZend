<?php

namespace Dream\Zend\I18n\View\Helper;

use Zend\I18n\View\Helper\Translate as ZendTranslate;

class Translate extends ZendTranslate {
    public function __invoke($message, $locale = NULL, $textDomain = NULL) {
		return parent::__invoke($message, $textDomain, $locale);
    }
}
