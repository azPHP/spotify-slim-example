<?php
// Routes
use Slim\Http\Request;
use Slim\Http\Response;


$app->map(['GET','POST'], '/spotify', function(Request $request, Response $response, $args) {
    $data = ['albums' => null];

    if($request->isPost() && $search = $request->getParam('search'))
    {
        $data['albums'] = $this->albums->search($search);
    }

    return $this->renderer->render($response, 'spotify.phtml', $data);
});

$app->get('/spotify/album/{id}', function(Request $request, Response $response, $args) {
    $id = $args['id'];

    $album = $this->albums->getAlbum($id);

    return $this->renderer->render($response, 'album.phtml', ['album' => $album]);
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
