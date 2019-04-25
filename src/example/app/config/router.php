<?php

$router = $di->getRouter();

// Define your routes here
$router->add(
    '/index',
    [
        'controller' => 'index',
        'action'     => 'index',
    ]
);

$router->handle();
