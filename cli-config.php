<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
$settings = include __DIR__ . '/src/settings.php';
$doctrine_settings = $settings['settings']['doctrine'];

$config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $doctrine_settings['metadata']['paths'],
    $doctrine_settings['dev_mode'],
    $doctrine_settings['metadata']['proxy_dir'],
    null,
    false
);

$em = \Doctrine\ORM\EntityManager::create(
    $doctrine_settings['connection'],
    $config
);

return ConsoleRunner::createHelperSet($em);