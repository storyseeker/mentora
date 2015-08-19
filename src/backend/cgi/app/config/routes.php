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

$router->add("/team/card/{targetId}", array(
    'controller' => 'team',
    'action'     => 'get',
    'targetId'   => 1
));

$router->add("/team/card/create", array(
    'controller' => 'team',
    'action'     => 'create'
));

$router->add("/team/card/set/{targetId}/{field}", array(
    'controller' => 'team',
    'action'     => 'set',
    'targetId'   => 1,
    'field'      => 2
));

$router->add("/team/leader/add", array(
    'controller' => 'team',
    'action'     => 'addLeader'
));

$router->add("/team/leader/del/{leaderId}", array(
    'controller' => 'team',
    'action'     => 'delLeader'
));

$router->add("/team/leader/update", array(
    'controller' => 'team',
    'action'     => 'updateLeader'
));

return $router;
