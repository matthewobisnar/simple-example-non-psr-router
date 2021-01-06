<?php
namespace router;

use Closure;

class Router
{
    public $basePath;

    public $routes = [];

    public $middleware = [];

    public function __construct($dir)
    {
        $this->basePath = $dir;
    }

    public function map($method, $uri, $concrete)
    {
        $uri = strtolower(trim($uri, "/"));

        $this->routes[$uri]['closure'] = $concrete;
        $this->routes[$uri]['verbs'] = array_map('strtolower', $method);
        
        return $this;
    }

    public function match($request_uri, $request_method)
    {

        if (isset($this->routes[$request_uri])) {

            if (in_array($request_method, $this->routes[$request_uri]['verbs'])) {
                return true;
            } else {
                die(json_encode(array("status"=> 300, "Invalid Method.")));
            }
        }

        die(json_encode(array("status"=> 404, "Api not found.")));

    }

    public function dispatch($server)
    {
        $request_uri = strtolower(trim($server['REQUEST_URI'], "/"));
        $request_method = strtolower($server['REQUEST_METHOD']);

        if ($this->match($request_uri, $request_method)) {
            
            $route = $this->routes[$request_uri]['closure'];

            if ($route instanceof Closure) {
                die(var_dump(call_user_func($route)));
            }

            if (is_string($route)) {
                $this->callAction($route);
            }

            if (is_array($route)) {
                $this->callAction($route);
            }

        }
    }

    public function callAction($controllers) {

        if (is_string($controllers)) {

            list($controller, $action) = preg_split('/[@]+/', preg_replace('/\/+/', "\\", ucfirst($controllers)));
       
        } else {
       
            $controller = preg_replace('/\/+/', '\\', ucfirst($controllers['controller']));
            $action = $controllers['action'];
       
        }

        if (is_callable(array($controller, $action))) {
            
            $new = new $controller;

            die(json_encode($new->{$action}()));

        } else {
            
            die(json_encode(array('status' => 404, "description" => 'controller is not callable')));
        
        }
    }

    public function getRoutes()
    {
        return $this->routes;
    }

}

?>