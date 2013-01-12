<?php

namespace Dream\Zend\Loader;

require_once 'library/Zend/Loader/StandardAutoloader.php';

use Zend\Loader\StandardAutoloader as ZendStandardAutoloader;

class StandardAutoloader extends ZendStandardAutoloader {
	const localPath = 'local/';
    protected function loadClass($class, $type) {
        if (!in_array($type, array(self::LOAD_NS, self::LOAD_PREFIX, self::ACT_AS_FALLBACK))) {
            require_once __DIR__ . '/Exception/InvalidArgumentException.php';
            throw new Exception\InvalidArgumentException();
        }

        // Fallback autoloading
        if ($type === self::ACT_AS_FALLBACK) {
            // create filename
            $filename     = $this->transformClassNameToFilename($class, '');
			if (file_exists($path = self::localPath.$filename) === true) {
				$resolvedName = stream_resolve_include_path($path);
				if ($resolvedName !== false) {
					return include $resolvedName;
				}
			}
            $resolvedName = stream_resolve_include_path($filename);
            if ($resolvedName !== false) {
                return include $resolvedName;
            }
            return false;
        }

        // Namespace and/or prefix autoloading
        foreach ($this->$type as $leader => $path) {
            if (0 === strpos($class, $leader)) {
                // Trim off leader (namespace or prefix)
                $trimmedClass = substr($class, strlen($leader));

                // create filename
                $filename = $this->transformClassNameToFilename($trimmedClass, $path);
				if (file_exists($path = self::localPath.$filename) === true) {
					return include $path;
				} else if (file_exists($filename)) {
                    return include $filename;
                }
                return false;
            }
        }
        return false;
    }
}
