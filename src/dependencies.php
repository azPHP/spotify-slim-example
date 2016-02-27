<?php
// DIC configuration


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
        $settings['dev_mode']
    );

    $em = \Doctrine\ORM\EntityManager::create(
        $settings['connection'],
        $config
    );
    return $em;
};