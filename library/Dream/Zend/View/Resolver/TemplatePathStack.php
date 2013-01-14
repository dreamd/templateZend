<?php

namespace Dream\Zend\View\Resolver;

use Zend\View\Resolver\TemplatePathStack as ZendTemplatePathStack;
use Zend\View\Renderer\RendererInterface as Renderer;
use SplFileInfo;

class TemplatePathStack extends ZendTemplatePathStack {
	protected $defaultSuffix = array('html', 'haml', 'jade', 'phtml', 'css', 'less', 'lass', 'js', 'coffee');
	public function addPathBefore($path = NULL) {
        if (!is_string($path)) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Invalid path provided; must be a string, received %s',
                gettype($path)
            ));
        }
		$this->paths->unshift(static::normalizePath($path));	
        return $this;
	}
    public function resolve($name, Renderer $renderer = NULL) {
		$this->addPathBefore(getcwd().'/local/resources/ShareResources/views');
		$this->addPathBefore(getcwd().'/resources/ShareResources/views');
        $this->lastLookupFailure = false;
        if ($this->isLfiProtectionOn() && preg_match('#\.\.[\\\/]#', $name)) {
            throw new Exception\DomainException(
                'Requested scripts may not include parent directory traversal ("../", "..\\" notation)'
            );
        }
        if (!count($this->paths)) {
            $this->lastLookupFailure = static::FAILURE_NO_PATHS;
            return false;
        }

        // Ensure we have the expected file extension
        $defaultSuffixs = $this->getDefaultSuffix();
        foreach ($this->paths as $path) {
			$name = str_replace(' ', '/', ucwords(str_replace('/', ' ', $name)));
			for ($i = 0; $i < count($defaultSuffixs); $i++) {
				if (realpath($path . $name.'.'.$defaultSuffixs[$i]) !== false) {
					$name = $name.'.'.$defaultSuffixs[$i];
					break;	
				}
			}
            $file = new SplFileInfo($path . $name);
            if ($file->isReadable()) {
                // Found! Return it.
                if (($filePath = $file->getRealPath()) === false && substr($path, 0, 7) === 'phar://') {
                    // Do not try to expand phar paths (realpath + phars == fail)
                    $filePath = $path . $name;
                    if (!file_exists($filePath)) {
                        break;
                    }
                }
                if ($this->useStreamWrapper()) {
                    // If using a stream wrapper, prepend the spec to the path
                    $filePath = 'zend.view://' . $filePath;
                }
                return $filePath;
            }
        }
        $this->lastLookupFailure = static::FAILURE_NOT_FOUND;
        return false;
    }
}
