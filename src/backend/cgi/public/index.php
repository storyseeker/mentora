<?php

use Phalcon\Loader;
use Phalcon\Tag;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Config\Adapter\Ini as ConfigIni;

define('APP_PATH', realpath('..') . '/');
define('CONFIG_PATH', APP_PATH . 'app/config/config.ini');
define('COMPILED_VIEW_PATH', APP_PATH. 'app/compiled-views/');

try {
    // Read the configuration
    $config = new ConfigIni(CONFIG_PATH);

    // Register an autoloader
    $loader = new Loader();
    $loader->registerDirs(
        array(
            APP_PATH . $config->application->controllersDir,
            APP_PATH . $config->application->modelsDir,
        )
    )->register();

    // Create a DI
    $di = new FactoryDefault();

    // Set the database service
    /*
    $di['db'] = function() {
        return new DbAdapter(array(
            "host"     => "localhost",
            "username" => "root",
            "password" => "secret",
            "dbname"   => "tutorial"
        ));
    };
    */

    //Register Volt as a service
    $di->set('voltService', function($view, $di) {

        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

        $volt->setOptions(array(
            "compiledPath" => COMPILED_VIEW_PATH,
            "compiledExtension" => ".php"
        ));

        return $volt;
    });

    // Setting up the view component
    $di['view'] = function() {
        $view = new View();
        $view->setViewsDir('../app/views/');
        $view->disableLevel(array(
            View::LEVEL_LAYOUT      => true,
            View::LEVEL_MAIN_LAYOUT => true
        ));
        $view->registerEngines(array(
            ".phtml" => 'voltService',
            ".volt" => 'voltService',
        ));
        return $view;
    };

    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di['url'] = function() {
        $url = new Url();
        $url->setBaseUri($config->application->baseUri);
        return $url;
    };

    // Setup the tag helpers
    $di['tag'] = function() {
        return new Tag();
    };

    // Handle the request
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch(Exception $e) {
    //echo "Exception: ", $e->getMessage();
    header('HTTP/1.0 404 Not Found'); 
}
