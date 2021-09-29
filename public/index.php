<?php

require __DIR__ . '/../vendor/autoload.php';

use Src\Core\Router;
use Src\Core\Response;
use Src\Core\Container;
use Src\App\CalendarClient;
use Src\App\CalendarController;
use Src\Core\ExceptionHandler;


$response = new Response;
new ExceptionHandler($response);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

Container::add('response', $response);
Container::add('calendarClient', (new CalendarClient)());

$router = new Router;

/*
GET /expenses
GET /expenses/{id}
POST /expenses
PUT /expenses/{id}
DELETE /expenses/{id}
*/

$router->get(
    '/next-event',
    [CalendarController::class, 'nextEvent']
);
$router->get(
    '/events-since/([0-9\-]+)',
    [CalendarController::class, 'eventsByDateSince']
);

// $router->get(
//     '/expenses/([0-9]+)',
//     [ExpenseController::class, 'getBy']
// );

// $router->post(
//     '/expenses',
//     [ExpenseController::class, 'store']
// );

// $router->put(
//     '/expenses/([0-9]+)',
//     [ExpenseController::class, 'update']
// );

// $router->delete(
//     '/expenses/([0-9]+)',
//     [ExpenseController::class, 'remove']
// );

$router->run();
