<?php
// Routes

use Doctrine\ORM\EntityManager;
use Slim\Http\Response;


$app->get('/spotify', function($request, Response $response, $args) {
    /** @var EntityManager $em */
    $em = $this->entity_manager;
    return $response->write(print_r(
        $em->getConnection()
            ->executeQuery("select date('now')")
            ->fetchColumn(),
        true));
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
