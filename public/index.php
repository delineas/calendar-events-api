<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\Core\Router;
use Src\Core\Response;
use Src\Core\Container;
use Src\Core\ExceptionHandler;
use Src\App\ExtractOembedController;

date_default_timezone_set('Europe/Madrid');

$response = new Response;
new ExceptionHandler($response);

function is_local()
{
    if (
        strpos($_SERVER['HTTP_HOST'], 'localhost') !== false
        || substr($_SERVER['HTTP_HOST'], 0, 3) == '10.'
        || substr($_SERVER['HTTP_HOST'], 0, 7) == '192.168'
    ) return true;
    return false;
}

if(is_local()) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
}

Container::add('response', $response);

$router = new Router;

$router->get(
    '/api/extract/(.*)',
    [ExtractOembedController::class, 'extract']
);

$router->run();
