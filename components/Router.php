<?php
/**
 * Component Router
 */

class Router
{
	private $routes;

	public function __construct()
	{
		$routesPath = ROOTPATH . '/config/routes.php';
		$this->routes = include($routesPath);
	}

	/**
	 * Return request string
	 * @return string
	 */
	private function getURI()
	{
		if (!empty($_SERVER['REQUEST_URI'])) {
			return $uri = trim($_SERVER['REQUEST_URI'], '/');
		}
		return '';
	}

	public function run()
	{
		$pathFound = false;
		$controllerName = false;
		$uri = $this->getURI();

		foreach ($this->routes as $uriPattern => $path) {
			if ($uriPattern == $uri) {
				$pathFound = true;
				$segments = explode('/', $path);
				$controllerName = ucfirst(array_shift($segments) . 'Controller');
				$actionName = 'action' . ucfirst(array_shift($segments));
				break;
			}
		}

		// default route if path not found
		if ($pathFound == false) {
			$controllerName = 'TaskController';
			$actionName = 'actionList';
		}

		if ($controllerName != false) {
			$controllerFile = ROOTPATH . '/controllers/' . $controllerName . '.php';

			if (file_exists($controllerFile)) {
				include_once($controllerFile);
			}

			$objController = new $controllerName;
			$arParams = $_GET;
			$objController->$actionName($arParams);
		}
	}
}