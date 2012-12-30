<?php

namespace Dream\Zend\I18n\View;

use Zend\I18n\View\HelperConfig as ZendHelperConfig;

class HelperConfig extends ZendHelperConfig {
    protected $invokables = array(
        'currencyformat'  => 'Zend\I18n\View\Helper\CurrencyFormat',
        'dateformat'      => 'Zend\I18n\View\Helper\DateFormat',
        'numberformat'    => 'Zend\I18n\View\Helper\NumberFormat',
        'translate'       => 'Dream\Zend\I18n\View\Helper\Translate',
        'translateplural' => 'Zend\I18n\View\Helper\TranslatePlural',
    );
}
