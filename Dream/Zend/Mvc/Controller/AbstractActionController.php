<?php

namespace Dream\Zend\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;
use Zend\Mvc\Exception, Zend\Mvc\MvcEvent, Zend\View\Model\ViewModel, Zend\Stdlib\ParametersInterface;
use Zend\Stdlib\ArrayUtils, Zend\View\Model\ModelInterface, Dream\Twig\Assign;
use Dream\Zend\View\Renderer\PhpRenderer, Zend\Mvc\Service\ViewHelperManagerFactory;
use Zend\View\Helper\BasePath;
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
		var_dump($actionResponse);
		$actionResponse->twig = $this->assign;
		$e->setResult($actionResponse);
		return $actionResponse;
    }
	public function getModulerName() {
		$controllerFullName = (string)$this->getEvent()->getRouteMatch()->getParam('controller', NULL);
		return substr($controllerFullName, 0, strpos($controllerFullName, '\\'));
	}
	public function getControllerName() {
		$controllerFullName = (string)$this->getEvent()->getRouteMatch()->getParam('controller', NULL);
		return substr($controllerFullName, (strlen($controllerFullName) - strrpos($controllerFullName, '\\')) * -1 + 1);
	}
	public function getControllerFullName() {
		return $this->getEvent()->getRouteMatch()->getParam('controller', NULL);
	}
	public function getActionName() {
		return $this->getEvent()->getRouteMatch()->getParam('action', NULL);
	}
	public function getRouteName() {
		return $this->getEvent()->getRouteMatch()->getMatchedRouteName();
	}
	
	public function isPost() {
        return $this->getRequest()->isPost();
	}
	public function getPost($name = NULL, $default = NULL) {
		return $this->getRequest()->getPost($name, $default);
	}
	public function setPost(ParametersInterface $query) {
		return 	$this->getRequest()->setPost($query);
	}
	
	public function isGet() {
        return $this->getRequest()->isGet();
	}
	public function getQuery($name = NULL, $default = NULL) {
		return $this->getRequest()->getQuery($name, $default);
	}
	public function setQuery(ParametersInterface $query) {
		return 	$this->getRequest()->setQuery($query);
	}
	
	public function getFiles($name = NULL, $default = NULL) {
		return $this->getRequest()->getFiles($name, $default);
	}
    public function setFiles(ParametersInterface $files) {
		return $this->getRequest()->setFiles($files);
	}
	
    public function getCookie() {
        return $this->getRequest()->getHeaders()->get('Cookie');
    }
    public function getHeader($name = NULL, $default = false) {
		return $this->getRequest()->getHeaders($name, $default);
	}
	public function setHeader($name = NULL, $value = NULL) {
		if (is_string($name) === true) {
			$this->response->getHeaders()->addHeaderLine($name, $value);
		}
		return $this;
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
	public function redirect($link) {
		if (is_string($link) === true && empty($link) === false) {
			$this->redirect()->toUrl($link);
		}
		return $this;
	}
	public function routeLink($route = NULL, array $params = array()) {
		
	}
	public function __call($method, $argv) {
		$helper = $this->serviceLocator->get('ViewHelperManager')->get($method);
		if (is_callable($helper)) {
            return call_user_func_array($helper, $argv);
        }
        return $helper;
	}
}
