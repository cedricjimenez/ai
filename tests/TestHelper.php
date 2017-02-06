<?php
/**
 * User: cjimenez
 * Date: 14/09/16 00:04
 */

use Phalcon\Di;
use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;

ini_set("display_errors", 1);
error_reporting(E_ALL);

define("ROOT_PATH", __DIR__);

set_include_path(
    ROOT_PATH . PATH_SEPARATOR . get_include_path()
);


// Use the application autoloader to autoload the classes
// Autoload the dependencies found in composer
require_once __DIR__ . "/../app/config.php";


Di::reset();

// Add any needed services to the DI here

Di::setDefault($di);