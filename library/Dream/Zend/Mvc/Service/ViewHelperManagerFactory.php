<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ViewHelperManagerFactory as ZendViewHelperManagerFactory;

class ViewHelperManagerFactory extends ZendViewHelperManagerFactory {
    protected $defaultHelperMapClasses = array(
        'Zend\Form\View\HelperConfig',
        'Zend\I18n\View\HelperConfig',//will change
        'Zend\Navigation\View\HelperConfig'
    );
}
