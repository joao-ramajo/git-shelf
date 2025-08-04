<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php';

use Api\Http\Router;

$router = new Router();

$router->get('/', 'MainController@index');
$router->get('git/{name}', 'MainController@json');

return $router;