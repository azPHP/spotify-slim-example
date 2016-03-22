<?php


namespace SpotifyApp\Routing;


use Slim\App;

class PowerRoute
{
    const ROUTE = '/power/{placeholder}';
    const CONTROLLER = '\SpotifyApp\Controller\Example';

    static function apply(App $app) {
        $app->get(static::ROUTE, static::CONTROLLER);
    }
}