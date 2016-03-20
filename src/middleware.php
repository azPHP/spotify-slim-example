<?php
// Application middleware
use Psr7Middlewares\Middleware\ResponseTime;

$app->add(new ResponseTime);
