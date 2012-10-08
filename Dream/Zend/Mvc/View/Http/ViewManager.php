<?php

namespace Dream\Zend\Mvc\View\Http;

use Zend\Mvc\View\Http\ViewManager as ZendViewManager;
use Dream\Zend\View\Renderer\PhpRenderer as ViewPhpRenderer;
use Zend\Mvc\View\Http\CreateViewModelListener, Zend\Mvc\View\Http\InjectTemplateListener;
use Zend\Mvc\View\Http\InjectViewModelListener, Zend\Mvc\View\SendResponseListener, Zend\Mvc\MvcEvent;


class ViewManager extends ZendViewManager {
    public function getRenderer() {
        if ($this->renderer) {
            return $this->renderer;
        }

        $this->renderer = new ViewPhpRenderer;
        $this->renderer->setHelperPluginManager($this->getHelpermanager());
        $this->renderer->setResolver($this->getResolver());

        $model       = $this->getViewModel();
        $modelHelper = $this->renderer->plugin('view_model');
        $modelHelper->setRoot($model);

        $this->services->setService('ViewRenderer', $this->renderer);
        $this->services->setAlias('Dream\Zend\View\Renderer\PhpRenderer', 'ViewRenderer');
        $this->services->setAlias('Zend\View\Renderer\RendererInterface', 'ViewRenderer');

        return $this->renderer;
    }
}
