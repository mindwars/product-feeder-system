<?php
ini_set('display_startup_errors', 0);
ini_set('display_errors', 0);
error_reporting(0);

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../config/app.php';

setlocale(LC_ALL, $config['locale']);
date_default_timezone_set($config['timezone']);

use System\Kernel;
use System\Response;

$kernel = new Kernel();
$response = new Response();

try {
    $kernel->handle();
} catch (\Exception $e) {
    $response->setStatusCode($e->getCode())->setBody($e->getMessage())->handle();
}
