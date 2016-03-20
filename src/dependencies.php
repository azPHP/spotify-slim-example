<?php
// DIC configuration


use SpotifyApp\Controller\Example;

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

$container['entity_manager'] = function ($c) {
    $settings = $c->get('settings')['doctrine'];

    $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $settings['metadata']['paths'],
        $settings['dev_mode'],
        $settings['metadata']['proxy_dir'],
        null,
        false
    );

    $em = \Doctrine\ORM\EntityManager::create(
        $settings['connection'],
        $config
    );
    return $em;
};

// album manager
$container['albums'] = function ($c) {
    $spotify_manager = new \SpotifyApp\Service\SpotifyManager();
    $album_manager = new \SpotifyApp\Service\AlbumManager(
        $c['entity_manager'],
        $spotify_manager
    );
    return $album_manager;
};

$container['l33t_controller'] = function ($c){
    $controller = new Example();
    return [$controller, 'l33t'];
};