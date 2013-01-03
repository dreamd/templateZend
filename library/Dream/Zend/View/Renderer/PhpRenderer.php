<?php

namespace Dream\Zend\View\Renderer;

use Zend\View\Renderer\PhpRenderer as ZendPhpRenderer;
use Dream\Twig\Loader\ZendRendererLoader, Dream\Twig\Environment;
use Dream\Everzet\Jade\Jade, Everzet\Jade\Parser, Everzet\Jade\Lexer\Lexer;
use Everzet\Jade\Dumper\PHPDumper, Everzet\Jade\Visitor\AutotagsVisitor, Everzet\Jade\Filter\JavaScriptFilter;
use Everzet\Jade\Filter\CDATAFilter, Everzet\Jade\Filter\PHPFilter, Everzet\Jade\Filter\CSSFilter;
use Dream\Zend\View\Model\ViewModel;

class PhpRenderer extends ZendPhpRenderer {
	public function render($nameOrModel = NULL, $values = NULL) {
		if ($nameOrModel instanceof ViewModel === false) {
			return parent::render($nameOrModel, $values);
		}
		if ($nameOrModel->useTwig() === true) { 
			$loader = new ZendRendererLoader($this);
			$loader->setTemplatePath($nameOrModel->getTemplate());
			$loader->addFile($loader->templatePath(), parent::render($nameOrModel, $values));
			$twig = new Environment($loader, array('cache' => false));
			$render = $twig->render($loader->templatePath(), (array)$nameOrModel->getVariables());
		} else {
			$render = $twig->render($loader->templatePath(), $nameOrModel);
		}
		switch ($nameOrModel->currentFormat()) {
			case 'JADE' : {
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
			case 'HAML' : {
					return $render;
			}
			default : {
					return $render;
			}
		}
	}
	public function extend($nameOrModel = NULL, $values = NULL) {
		return parent::render($nameOrModel, $values);
	}
}
