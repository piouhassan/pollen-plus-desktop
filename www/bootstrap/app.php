<?php

require  __DIR__."/../vendor/autoload.php";


// Add Routing To the Project

$router = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $route) {

    // Web Router File Loading
    require __DIR__."/../routes/web.php";

    // Rest Api Router File Loading
    require  __DIR__."/../routes/api.php";
});

$session = new \Akuren\Session\Session();



$harmony = new WoohooLabs\Harmony\Harmony(Zend\Diactoros\ServerRequestFactory::fromGlobals(), new Zend\Diactoros\Response());








