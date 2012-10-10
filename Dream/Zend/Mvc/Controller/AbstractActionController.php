<?php

namespace Dream\Zend\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;
use Zend\Mvc\Exception, Zend\Mvc\MvcEvent, Zend\View\Model\ViewModel;
use Zend\Stdlib\ArrayUtils, Zend\View\Model\ModelInterface, Dream\Twig\Assign;
/*
use Dream\Zend\View\Renderer\PhpRenderer, Zend\Mvc\Service\ViewHelperManagerFactory;
*/
abstract class AbstractActionController extends ZendAbstractActionController {
    protected $eventIdentifier = __CLASS__, $assign;
    public function indexAction() {

    }
    public function notFoundAction() {
        $response   = $this->response;
        $event      = $this->getEvent();
        $routeMatch = $event->getRouteMatch();

        $response->setStatusCode(404);
        $routeMatch->setParam('action', 'not-found');
    }
    public function onDispatch(MvcEvent $e) {
        $routeMatch = $e->getRouteMatch();
        if (!$routeMatch) {
            throw new Exception\DomainException('Missing route matches; unsure how to retrieve action');
        }
		$this->assign = new Assign();
        $action = $routeMatch->getParam('action', 'not-found');
        $method = static::getMethodFromAction($action);

        if (!method_exists($this, $method)) {
            $method = 'notFoundAction';
        }
        $actionResponse = $this->$method();
		if (is_array($actionResponse) === true) {
			if (ArrayUtils::hasStringKeys($actionResponse, true)) {
				$actionResponse = new ViewModel($actionResponse);
				$actionResponse->setTerminal(true);
			} else {
				$actionResponse = new ViewModel();
				$actionResponse->setTerminal(true);
			}
        } else if (is_string($actionResponse) === true) {
            $actionResponse = new ViewModel(array($actionResponse => $actionResponse));
			$actionResponse->setTerminal(true);
		} else if ($actionResponse === NULL) {
            $actionResponse = new ViewModel();
			$actionResponse->setTerminal(true);
		} else if ($actionResponse instanceof ModelInterface) {
			$actionResponse->setTerminal(true);
		}
		$actionResponse->twig = $this->assign;
		$e->setResult($actionResponse);
		return $actionResponse;
    }
    public function __call($method, $params) {
        $plugin = $this->plugin(strtolower($method));
        if (is_callable($plugin)) {
            return call_user_func_array($plugin, $params);
        }
        return $plugin;
    }
	
	public function isOptions() {
        return $this->getRequest()->isOptions();
	}
	public function isHead() {
        return $this->getRequest()->isHead();
	}
    public function isPut() {
		return $this->getRequest()->isPut();
    }
    public function isDelete() {
		return $this->getRequest()->isDelete();
    }
    public function isTrace() {
		return $this->getRequest()->isTrace();
    }
    public function isConnect() {
		return $this->getRequest()->isConnect();
    }
    public function isPatch() {
		return $this->getRequest()->isPatch();
    }
    public function isXmlHttpRequest() {
		return $this->getRequest()->isXmlHttpRequest();
    }
    public function isFlashRequest() {
		return $this->getRequest()->isFlashRequest();
    }
	public function setStatusCode($statusCode = NULL) {
		if (is_null($statusCode) === false && is_int($statusCode) === true) { 
			$this->response->setStatusCode($statusCode);
		}
		return $this;
	}
	public function setParam($param = NULL, $default = NULL) {
		if (is_string($param) === true && empty($param) === false) {
			$this->getEvent()->getRouteMatch()->setParam($param, $default);
		}
		return $this;
	}
	public function getParam($param = NULL, $default = NULL) {
		return $this->getEvent()->getRouteMatch()->getParam($param, $default);
	}
	public function redirectRoute($route = null, array $params = array(), $options = array(), $reuseMatchedParams = false) {
		$this->redirect()->toRoute($route, $params, $options, $reuseMatchedParams);
		return $this;
	}
	public function redirectUrl($link) {
		if (is_string($link) === true && empty($link) === false) {
			$this->redirect()->toUrl($link);
		}
		return $this;
	}
	public function getLink($route = NULL, array $params = array()) {
		if ($route !== NULL) {
			return $this->url()->fromRoute($route, $params);
		}
		return NULL;
	}
	public function __call($method, $argv) {
		$helper = $this->serviceLocator->get('ViewHelperManager')->get($method);
		if (is_callable($helper)) {
            return call_user_func_array($helper, $argv);
        }
        return $helper;
	}
	*/
}
