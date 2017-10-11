<?php

namespace ErikFig;

use ErikFig\Router\Router;
use ErikFig\DI\Resolver;
use ErikFig\Renderer\PHPRendererInterface;

class App
{
    private $router;
    private $renderer;

    public function __construct()
    {
        $path_info = $_SERVER['PATH_INFO'] ?? '/';
        $request_method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        $this->router = new Router($path_info, $request_method);
    }

    public function setRenderer(PHPRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    public function get(string $path, $fn)
    {
        $this->router->get($path, $fn);
    }

    public function post(string $path, $fn)
    {
        $this->router->post($path, $fn);
    }

    public function run()
    {
        $route = $this->router->run();
        $resolver = new Resolver;

        if (is_string($route['callback'])) {
            $data = $this->resolveController($route);
        } else {
            $data = $resolver->method($route['callback'], ['params'=>$route['params']]);
        }

        $this->renderer->setData($data);
        $this->renderer->run();
    }

    protected function resolveController(array $route)
    {
        $controllerAction = explode('@', $route['callback']);
        if (count($controllerAction) !== 2) {
            throw new \Exception('Invalid controller and action');
        }

        $resolver = new Resolver;

        $controller = $resolver->class($controllerAction[0], ['params' => $route['params']]);
        $action = $controllerAction[1];

        return $controller->$action();
    }
}
