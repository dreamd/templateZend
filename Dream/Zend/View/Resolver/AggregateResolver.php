<?php

namespace Dream\Zend\View\Resolver;

use Zend\View\Resolver\AggregateResolver as ZendAggregateResolver;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\Stdlib\PriorityQueue, Zend\View\Exception;


class AggregateResolver extends ZendAggregateResolver {
    public function resolve($name, Renderer $renderer = null) {
		$name = str_replace(' ', DIRECTORY_SEPARATOR, ucwords(str_replace(DIRECTORY_SEPARATOR, ' ', trim($name))));
        $this->lastLookupFailure      = false;
        $this->lastSuccessfulResolver = null;

        if (0 === count($this->queue)) {
            $this->lastLookupFailure = static::FAILURE_NO_RESOLVERS;
            return false;
        }

        foreach ($this->queue as $resolver) {
            $resource = $resolver->resolve($name, $renderer);
            if (!$resource) {
                // No resource found; try next resolver
                continue;
            }

            // Resource found; return it
            $this->lastSuccessfulResolver = $resolver;
            return $resource;
        }

        $this->lastLookupFailure = static::FAILURE_NOT_FOUND;
        return false;
    }
