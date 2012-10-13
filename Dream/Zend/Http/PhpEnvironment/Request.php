<?php

namespace Dream\Zend\Http\PhpEnvironment;

use Zend\Http\PhpEnvironment\Request as ZendRequest;
use Dream\Zend\Http\Header\Cookie;

class Request extends ZendRequest {
    public function setCookies($cookie) {
        $this->getHeaders()->addHeader(new Cookie((array) $cookie));
        return $this;
    }
}
