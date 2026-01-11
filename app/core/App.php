<?php

class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // BASE PATH = /public_html/app
        $basePath = dirname(__DIR__);

        // Controller
        if (isset($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            if (file_exists($basePath . '/controllers/' . $controllerName . '.php')) {
                $this->controller = $controllerName;
                unset($url[0]);
            }
        }

        require_once $basePath . '/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // Params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array(
            [$this->controller, $this->method],
            $this->params
        );
    }

    private function parseURL()
    {
        if (isset($_GET['url'])) {
            return explode('/', rtrim($_GET['url'], '/'));
        }
        return [];
    }
}
