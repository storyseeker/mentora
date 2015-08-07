<?php

use Phalcon\Mvc\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        $this->view->setVars(array(
            'title' => 'David',
            'content' => 'Crown'
        ));
    }
}
