<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH.'/vendor/autoload.php';

use User\Framework\http\Kernel;
use User\Framework\http\Request;
use User\Framework\Routing\Router;

$request = Request::createFromGlobals();
$router = new Router;
$kernel = new Kernel($router);
$kernel->handle($request)->send();
