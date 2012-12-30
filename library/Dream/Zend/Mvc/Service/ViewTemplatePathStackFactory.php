<?php

namespace Dream\Zend\Mvc\Service;

use Zend\Mvc\Service\ViewTemplatePathStackFactory as ZendViewTemplatePathStackFactory;
use Dream\Zend\View\Resolver\TemplatePathStack, Zend\ServiceManager\ServiceLocatorInterface;

class ViewTemplatePathStackFactory extends ZendViewTemplatePathStackFactory {
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('Config');
        $stack = array();
        if (is_array($config) && isset($config['view_manager'])) {
            $config = $config['view_manager'];
            if (is_array($config) && isset($config['template_path_stack'])) {
                $stack = $config['template_path_stack'];
            }
        }

        $templatePathStack = new TemplatePathStack();
        $templatePathStack->addPaths($stack);
        return $templatePathStack;
    }
}
