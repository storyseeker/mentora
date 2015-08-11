<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add("/login/{account}/{password}", array(
    'controller' => 'login',
    'action'     => 'index',
    'account'    => 1,
    'password'   => 2,
));

return $router;
