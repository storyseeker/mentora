<?php

use Phalcon\Loader;
use Phalcon\Tag;
use Phalcon\Mvc\Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Config\Adapter\Ini as ConfigIni;
use Phalcon\Crypt;
use Phalcon\Logger\Adapter\File as FileLogger;

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
            APP_PATH . "/app/library/",
            APP_PATH . "/app/config/",
            APP_PATH . "/app/logics/"
        )
    )->register();

    // Create a DI
    $di = new FactoryDefault();

    // Set the database service
    $di['db'] = function() {
        return new DbAdapter(array(
            "host"     => "localhost",
            "username" => "mentora",
            "password" => "mentora",
            "dbname"   => "mentora"
        ));
    };

    // Set the Logger Handler
    $di['logger'] = function() {
        return new FileLogger('../logs/debug.log');
    };

    //Register Volt as a service
    $di->set('voltService', function($view, $di) {

        $volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

        $volt->setOptions(array(
            "compiledPath" => COMPILED_VIEW_PATH,
            "compiledExtension" => ".php"
        ));

        return $volt;
    });

    $di->set('crypt', function() {
        $crypt = new Crypt();

        // 使用 blowfish
        $crypt->setCipher('blowfish');

        // 设置全局加密密钥
        $crypt->setKey('blowfish');

        return $crypt;
    }, true);

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
            ".json" => 'voltService',
        ));
        return $view;
    };

    // Setup a base URI so that all generated URIs include the "tutorial" folder
    $di['url'] = function() {
        $url = new Url();
        $url->setBaseUri("/cgi/");
        return $url;
    };

    // Setup the tag helpers
    $di['tag'] = function() {
        return new Tag();
    };

    // add routing capabilities
    $di->set('router', function () {
        require '../app/config/routes.php';
        return $router;
    });

    // Handle the request
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch(Exception $e) {
    echo "Exception: ", $e->getMessage();
    //header('HTTP/1.0 404 Not Found'); 
}
