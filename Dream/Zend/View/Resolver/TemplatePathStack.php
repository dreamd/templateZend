<?php

namespace Dream\Zend\View\Resolver;

use Zend\View\Resolver\TemplatePathStack as ZendTemplatePathStack;
use Zend\View\Renderer\RendererInterface as Renderer;
use SplFileInfo;

class TemplatePathStack extends ZendTemplatePathStack {
	protected $defaultSuffix = array('phtml', 'css', 'js');
    public function setDefaultSuffix($defaultSuffix) {
        $this->defaultSuffix[] = (string)ltrim($defaultSuffix, '.');
        return $this;
    }
    public function resolve($name, Renderer $renderer = NULL) {
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
			for ($i = 0; $i < count($defaultSuffixs); $i++) {
				if (realpath($path . $name.'.'.$defaultSuffixs[$i]) !== false) {
					$name = $name.'.'.$defaultSuffixs[$i];
					break;	
				}
			}
			if (pathinfo($name, PATHINFO_EXTENSION) === '') {;
				$name .= '.' . $defaultSuffixs[0];
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
