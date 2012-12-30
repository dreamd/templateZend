<?php

namespace Dream\Twig;

use Twig_Environment;

class Environment extends Twig_Environment {
    public function getTemplateClass($name = NULL, $index = NULL) {
		$name = substr((string)$name, 0, 1) === '.' ? '/'.(string)$name : $name;
        return $this->templateClassPrefix.md5($this->loader->getCacheKey($name)).(null === $index ? '' : '_'.$index);
    }
}