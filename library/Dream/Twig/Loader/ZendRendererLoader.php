<?php

namespace Dream\Twig\Loader;

use Twig_LoaderInterface, Dream\Zend\View\Renderer\PhpRenderer ;

class ZendRendererLoader implements Twig_LoaderInterface {
	private $files = array(), $renderer = NULL, $templatePath = false;
	const shareKeyword = 'SHARE';
	const sharePath = 'ShareResources';
	const currentPath = '.';
	const prevPath = '..';
	const rootPath = '~';
	const folderPrefix = '/';
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
			if (substr($path, -1) !== self::folderPrefix) {
				$this->templatePath = substr($path, 0, strrpos($path, self::folderPrefix) + 1);
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
		if (strpos($name, self::currentPath) === false) {
			$path = $name;
		} else {
			$path = substr($name, 0, strrpos($name, self::currentPath));
		}
		return $this->renderer->extend($this->fixPath($this->templatePath.$path));
    }
	private function fixPath($path) {
		$paths = array_filter(explode(self::folderPrefix, $path));
		for ($i = 0; $i < max(array_keys($paths)); $i++) {
			if (isset($paths[$i]) === true && $paths[$i] === self::shareKeyword) {
				$paths[$i] = self::sharePath;
				for ($j = $i - 1; $j >= 0; $j--) {
					if (isset($paths[$j]) === true) {
						unset($paths[$j]);
					}
				}
			} else if (isset($paths[$i]) === true && $paths[$i] === self::rootPath) {
				$paths[$i] = __PROJECT__;
				for ($j = $i - 1; $j >= 0; $j--) {
					if (isset($paths[$j]) === true) {
						unset($paths[$j]);
					}
				}
			} else if (isset($paths[$i]) === true && $paths[$i] === self::currentPath) {
				unset($paths[$i]);
			} else if (isset($paths[$i]) === true && $paths[$i] === self::prevPath) {
				unset($paths[$i]);
				for ($j = $i - 1; $j >= 0; $j--) {
					if (isset($paths[$j]) === true) {
						unset($paths[$j]);
						break;	
					}
				}
			}
		}
		return implode(self::folderPrefix, array_map(function($value) {
			return ucfirst($value);
		}, $paths));
	}
    public function getCacheKey($name = NULL) {
		if ($name !== NULL && array_key_exists($name, $this->files) === true) {
			return $name;	
		}
		if (strpos($name, self::currentPath) === false) {
			$path = $name;
		} else {
			$path = substr($name, 0, strpos($name, self::currentPath));
		}
        return $this->templatePath.$path;
    }
    public function isFresh($name, $time) {
        return true;
    }
}
