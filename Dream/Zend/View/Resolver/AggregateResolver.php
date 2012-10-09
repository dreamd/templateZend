<?php

namespace Dream\Zend\View\Resolver;

use Zend\View\Resolver\AggregateResolver as ZendAggregateResolver;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\Stdlib\PriorityQueue, Zend\View\Exception;


class AggregateResolver extends ZendAggregateResolver {
    public function resolve($name, Renderer $renderer = null) {
		$name = str_replace(' ', DIRECTORY_SEPARATOR, ucwords(str_replace(DIRECTORY_SEPARATOR, ' ', trim($name))));
		return parent::resolve($name, $renderer);
    }
}