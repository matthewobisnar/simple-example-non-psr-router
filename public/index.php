<?php
require __DIR__ . "../../vendor/autoload.php";

$router = new router\Router(__DIR__);

$router->map(['get'], '/index', function(){
    return "Hello Index";
});

$router->map(['get'], '/api/v1/test/edit', 'Api/v1/controller/TestController@index');
$router->map(['post', 'get'], '/api/v1/test/create', ['controller' => "Api/v1/controller/TestController", "action" => "create"]);

$router->dispatch($_SERVER);
