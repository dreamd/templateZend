<?php

namespace Dream\Zend\View\Renderer;

use Zend\View\Renderer\PhpRenderer as ZendPhpRenderer;
//use Dream\Twig\Loader\ZendRendererLoader, Dream\Twig\Environment;

class PhpRenderer extends ZendPhpRenderer {
	/*
	//zend
	public function render($nameOrModel, $values = null) {
        if ($nameOrModel instanceof Model) {
            $model       = $nameOrModel;
            $nameOrModel = $model->getTemplate();
            if (empty($nameOrModel)) {
                throw new Exception\DomainException(sprintf(
                    '%s: received View Model argument, but template is empty',
                    __METHOD__
                ));
            }
            $options = $model->getOptions();
            foreach ($options as $setting => $value) {
                $method = 'set' . $setting;
                if (method_exists($this, $method)) {
                    $this->$method($value);
                }
                unset($method, $setting, $value);
            }
            unset($options);

            // Give view model awareness via ViewModel helper
            $helper = $this->plugin('view_model');
            $helper->setCurrent($model);

            $values = $model->getVariables();
            unset($model);
        }

        // find the script file name using the parent private method
        $this->addTemplate($nameOrModel);
        unset($nameOrModel); // remove $name from local scope

        $this->__varsCache[] = $this->vars();

        if (null !== $values) {
            $this->setVars($values);
        }
        unset($values);

        // extract all assigned vars (pre-escaped), but not 'this'.
        // assigns to a double-underscored variable, to prevent naming collisions
        $__vars = $this->vars()->getArrayCopy();
        if (array_key_exists('this', $__vars)) {
            unset($__vars['this']);
        }
        extract($__vars);
        unset($__vars); // remove $__vars from local scope

        while ($this->__template = array_pop($this->__templates)) {
            $this->__file = $this->resolver($this->__template);
            if (!$this->__file) {
                throw new Exception\RuntimeException(sprintf(
                    '%s: Unable to render template "%s"; resolver could not resolve to a file',
                    __METHOD__,
                    $this->__template
                ));
            }
            ob_start();
            include $this->__file;
            $this->__content = ob_get_clean();
        }

        $this->setVars(array_pop($this->__varsCache));

        return $this->getFilterChain()->filter($this->__content); // filter output
    }
	*/
	/*
	//dream
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
	*/
}
