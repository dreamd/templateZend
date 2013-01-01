<?php

namespace Dream\Twig;

use Twig_Environment, Dream\Twig\Exception\EnvironmentException;

class Environment extends Twig_Environment {
    public function getTemplateClass($name = NULL, $index = NULL) {
		if (is_string($name) === false || strlen($name) < 1) {
			throw new EnvironmentException('Can not get cacheKey');	
		}
		$name = substr((string)$name, 0, 1) === '.' ? '/'.(string)$name : $name;
        return $this->templateClassPrefix.md5($this->loader->getCacheKey($name)).($index === NULL? '' : '_'.$index);
    }
}