<?php

namespace Dream\Everzet\Jade;

use Everzet\Jade\Jade as EverzetJade;

class Jade extends EverzetJade {
    public function render($source) {
        $parsed = $this->parser->parse($source);
        return $this->dumper->dump($parsed);
    }
}
