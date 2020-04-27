<?php
/**
 * Front controller
 */

session_start();

// connecting files
define('ROOTPATH', dirname(__FILE__));
require_once(ROOTPATH . '/components/Autoload.php');
require_once(ROOTPATH . '/config/config.php');

// call router
$router = new Router();

$router->run();