<?php
/**
 * User: cjimenez
 * Date: 14/09/16 04:21
 */


use \Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;


// Required for phalcon/incubator
include "../vendor/autoload.php";


// Register an autoloader
$loader = new Loader();


$loader->registerDirs([
    '../app/controllers/',
    '../app/models/',
    '../tests/'
])->registerNamespaces(
    array(
        "ai"   => "../app/models/"
    )
)->register();

// Create a DI
$di = new FactoryDefault();

// Setup the view component
$di->set('view', function () {
    $view = new View();
    $view->setViewsDir('../app/views/');
    return $view;
});

// Setup a base URI so that all generated URIs include the "tutorial" folder
$di->set('url', function () {
    $url = new UrlProvider();
    $url->setBaseUri('/ai/');
    return $url;
});

/**
 * Database config
 */
$di->set(
    'db',
    function () {
        return new DbAdapter(
            [
                'host' => 'ai-mysql',
                'username' => 'aiadmin',
                'password' => '%C3dr1c%',
                'dbname' => 'aidb'
            ]
        );
    },
    true
);


$di->set(
    'modelsManager',
    function()
    {
        return new \Phalcon\Mvc\Model\Manager();
    }
);




$application = new Application($di);