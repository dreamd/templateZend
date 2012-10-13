<?php

namespace Dream\Zend\Mvc\Controller;

use Zend\Mvc\Controller\AbstractActionController as ZendAbstractActionController;
use Zend\Mvc\Exception, Zend\Mvc\MvcEvent, Zend\View\Model\ViewModel;
use Zend\Stdlib\ArrayUtils, Zend\View\Model\ModelInterface, Dream\Twig\Assign;

abstract class AbstractActionController extends ZendAbstractActionController {
    protected $eventIdentifier = __CLASS__;
	private $requestMethod = array(
		'getmethod' => 'getMethod',
		'geturi' => 'getUri',
		'seturi' => 'setUri',
		'geturl' => 'getUriString',
		'getheader' => 'getHeader',
		'isoptions' => 'isOptions',
		'isget' => 'isGet',
		'ishead' => 'isHead',
		'ispost' => 'isPost',
		'isput' => 'isPut',
		'isdelete' => 'isDelete',
		'istrace' => 'isTrace',
		'isconnect' => 'isConnect',
		'ispatch' => 'isPatch',
		'isxmlhttprequest' => 'isXmlHttpRequest',
		'isflashrequest' => 'isFlashRequest',
	);
	private $param = array();
    public function indexAction() {

    }
    public function notFoundAction() {
        $response   = $this->response;
        $event      = $this->getEvent();
        $routeMatch = $event->getRouteMatch();

        $response->setStatusCode(404);
        $routeMatch->setParam('action', 'not-found');
    }
	public function __set($name = NULL, $value = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			$this->param[$name] = $value;	
		}
		return $this;
	}
	public function __get($name = NULL) {
		if ($name !== NULL && is_string($name) === true) {
			if (isset($this->param[$name]) === true) {
				return $this->param[$name];
			}
		}
		return NULL;
	}
	public function __isset($name = NULL) {
		return isset($this->param[$name]);	
	}
	public function __unset($name = NULL) {
		unset($this->param[$name]);
		return $this;
	}
	public function dispatchLayout() {
		return NULL;
	}
	protected function result(array $return = array()) {
		$this->result = array_merge((array)$this->result, $return);
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
        };
		$this->dispatchLayout();
		$this->$method();
		
		$actionResponse = $this->result;
		
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
		if (method_exists($this, $method) === true) {
			return $this->$method($params);	
		}
		$plugin = $this->requestMethod(strtolower($method));
		if ($plugin !== NULL) {
    	    return call_user_func_array(array($this->getRequest(), $plugin), $params);
		}
        $plugin = $this->controllerPlugin(strtolower($method));
		if ($plugin !== NULL) {
	        if (is_callable($plugin)) {
    	        return call_user_func_array($plugin, $params);
       		}
			return $plugin;
		}
		$plugin = $this->viewHelperPlugin($method);
		if (is_callable($plugin)) {
            return call_user_func_array($plugin, $params);
        }
        return $plugin;
    }
	public function requestMethod($method) {
		if (array_key_exists($method, $this->requestMethod)) {
			return $this->requestMethod[$method];
		}
		return NULL;
	}
	public function viewHelperPlugin($method = NULL) {
		if ($method !== NULL) {
			return $this->serviceLocator->get('ViewHelperManager')->get($method);
		}
		return NULL;
	}
    public function controllerPlugin($name = NULL) {
		if ($name !== NULL && $this->getPluginManager()->has($name) === true) {
        	return $this->getPluginManager()->get($name);
		}
		return NULL;
    }
	/*
	public function goToRoute() {
		
	}
	*/
}
