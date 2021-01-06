<?php

    $router->map(['get'], '/index', function(){
        return "Hello Index";
    });

    $router->map(['get'], '/api/v1/test/edit', 'Api/v1/controller/TestController@index');
    $router->map(['post', 'get'], '/api/v1/test/create', ['controller' => "Api/v1/controller/TestController", "action" => "create"]);
    $router->map(['post', 'get'], '/api/v1/test/sampleModel', ['controller' => "Api/v1/controller/TestController", "action" => "sampleModel"]);

?>