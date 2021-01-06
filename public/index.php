<?php
require __DIR__ . "../../vendor/autoload.php";

$router = new router\Router(__DIR__);

$router->localize(function($router){
    require __DIR__ . "../../routes/api.php";
});

$router->dispatch($_SERVER);