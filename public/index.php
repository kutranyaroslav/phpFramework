<?php

define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH.'/vendor/autoload.php';

use User\Framework\http\Kernel;
use User\Framework\http\Request;
use User\Framework\http\Response;

$request = Request::createFromGlobals();
$content = '<h1> Hello world it is my first response </h1>';
$response = new Response($content, 200, []);
$kernel = new Kernel;
$kernel->handle($request)->send();
