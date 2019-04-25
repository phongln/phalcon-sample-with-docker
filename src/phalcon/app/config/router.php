<?php

$router = $di->getRouter();

// Define your routes here
$router->add(
    "/",
    [
        "controller" => "index",
        "action"     => "index",
    ]
);

$router->handle();
