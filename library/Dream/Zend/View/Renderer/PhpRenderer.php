<?php

namespace Dream\Zend\View\Renderer;

use Zend\View\Renderer\PhpRenderer as ZendPhpRenderer;
use Dream\Twig\Loader\ZendRendererLoader, Dream\Twig\Environment;
use Dream\Everzet\Jade\Jade, Everzet\Jade\Parser, Everzet\Jade\Lexer\Lexer;
use Everzet\Jade\Dumper\PHPDumper, Everzet\Jade\Visitor\AutotagsVisitor, Everzet\Jade\Filter\JavaScriptFilter;
use Everzet\Jade\Filter\CDATAFilter, Everzet\Jade\Filter\PHPFilter, Everzet\Jade\Filter\CSSFilter;

class PhpRenderer extends ZendPhpRenderer {
    public function render($nameOrModel = NULL, $values = NULL) {
		$loader = new ZendRendererLoader($this);
		if (is_string($nameOrModel) === true) {
			$loader->setTemplatePath($nameOrModel);
		} else {
			$loader->setTemplatePath($nameOrModel->getTemplate());
		}
		$loader->addFile($loader->templatePath(), parent::render($nameOrModel, $values));
		$twig = new Environment($loader, array('cache' => false));
		if (is_string($nameOrModel) === true) {
			$render = $twig->render($loader->templatePath(), $nameOrModel);
		} else {
			$render = $twig->render($loader->templatePath(), (array)$nameOrModel->getVariables());
		}
		
		$dumper = new PHPDumper();
		$dumper->registerVisitor('tag', new AutotagsVisitor());
		$dumper->registerFilter('javascript', new JavaScriptFilter());
		$dumper->registerFilter('cdata', new CDATAFilter());
		$dumper->registerFilter('php', new PHPFilter());
		$dumper->registerFilter('style', new CSSFilter());
		
		$parser = new Parser(new Lexer());
		$jade   = new Jade($parser, $dumper);    
		return $jade->render($render);
	}
	public function extend($nameOrModel = NULL, $values = NULL) {
		return parent::render($nameOrModel, $values);
	}
}
