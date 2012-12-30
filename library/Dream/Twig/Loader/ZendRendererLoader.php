<?php

namespace Dream\Twig\Loader;

use Twig_LoaderInterface, Dream\Zend\View\Renderer\PhpRenderer ;

class ZendRendererLoader implements Twig_LoaderInterface {
	private $files = array(), $renderer = NULL, $templatePath = false;
	public function __construct(PhpRenderer $renderer) {
		$this->renderer = $renderer;
	}
	public function addFile($name = NULL, $value = NULL) {
		if ($name !== NULL && $value !== NULL) {
			$this->files[$name] = $value;	
		}
	}
	public function setTemplatePath($path = NULL) {
		if (is_string($path) === true && empty($path) === false) {
			if (substr($path, -1) !== '/') {
				$this->templatePath = substr($path, 0, strrpos($path, '/') + 1);
			} else {
				$this->templatePath = $path;
			}
		}
	}
	public function templatePath() {
		return 	$this->templatePath;
	}
    public function getSource($name = NULL) {
		if ($name !== NULL && array_key_exists($name, $this->files) === true) {
			return $this->files[$name];	
		}
		if (strpos($name, '.') === false) {
			$path = $name;
		} else {
			$path = substr($name, 0, strrpos($name, '.'));
		}
		return $this->renderer->extend($this->fixPath($this->templatePath.$path));
    }
	private function fixPath($path) {
		$paths = array_filter(explode('/', $path));
		for ($i = 0; $i < max(array_keys($paths)); $i++) {
			if (isset($paths[$i]) === true && $paths[$i] === '..') {
				unset($paths[$i]);
				for ($j = $i - 1; $j >= 0; $j--) {
					if (isset($paths[$j]) === true) {
						unset($paths[$j]);
						break;	
					}
				}
			}
		}
		return implode('/', $paths);
	}
    public function getCacheKey($name = NULL) {
		if ($name !== NULL && array_key_exists($name, $this->files) === true) {
			return $name;	
		}
		if (strpos($name, '.') === false) {
			$path = $name;
		} else {
			$path = substr($name, 0, strpos($name, '.'));
		}
        return $this->templatePath.$path;
    }
    public function isFresh($name, $time) {
        return true;
    }
}
