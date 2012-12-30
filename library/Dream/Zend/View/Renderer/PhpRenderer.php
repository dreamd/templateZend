<?php

namespace Dream\Zend\View\Renderer;

use Zend\View\Renderer\PhpRenderer as ZendPhpRenderer;
use Dream\Twig\Loader\ZendRendererLoader, Dream\Twig\Environment;

class PhpRenderer extends ZendPhpRenderer {
	private $__templateResolver;
    public function render($nameOrModel = NULL, $values = NULL) {
		$loader = new ZendRendererLoader($this);
		if (is_string($nameOrModel) === true) {
			$loader->setTemplatePath($nameOrModel);
		} else {
			$loader->setTemplatePath($nameOrModel->getTemplate());
		}
		$loader->addFile($loader->templatePath(), parent::render($nameOrModel, $values));
		$twig = new Environment($loader, array('cache' => false));
		return $twig->render($loader->templatePath(), get_object_vars($nameOrModel));
    }
	public function extend($nameOrModel = NULL, $values = NULL) {
		return parent::render($nameOrModel, $values);
	}
}
