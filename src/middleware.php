<?php
// Application middleware
use Psr7Middlewares\Middleware\BasicAuthentication;
use Psr7Middlewares\Middleware\ResponseTime;

$app->add(new BasicAuthentication(['azphp' => 'group']));

$app->add(new ResponseTime);
