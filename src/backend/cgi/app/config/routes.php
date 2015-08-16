<?php

use Phalcon\Mvc\Router;

$router = new Router();

$router->add("/login/{account}/{password}", array(
    'controller' => 'login',
    'action'     => 'index',
    'account'    => 1,
    'password'   => 2,
));

$router->add("/logout", array(
    'controller' => 'login',
    'action'     => 'logout'
));

$router->add("/signup", array(
    'controller' => 'signup',
    'action'     => 'index'
));

$router->add("/signup/verify/email/{email}", array(
    'controller' => 'signup',
    'action'     => 'checkEmail',
    'email'      => 1
));

$router->add("/signup/verify/phone/{phone}", array(
    'controller' => 'signup',
    'action'     => 'checkPhone',
    'phone'      => 1
));

$router->add("/user/card/{targetUid}", array(
    'controller' => 'usercard',
    'action'     => 'get',
    'targetUid'  => 1
));

$router->add("/user/card", array(
    'controller' => 'usercard',
    'action'     => 'get'
));

$router->add("/user/card/set/{field}", array(
    'controller' => 'usercard',
    'action'     => 'set',
    'field'      => 1
));

return $router;
