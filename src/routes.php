<?php
// Routes
use Psr7Middlewares\Middleware\BasicAuthentication;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

$app->group('/spotify', function() {
    /** @var App $app */
    $app = $this;

    $app->map(['GET','POST'], '', function(Request $request, Response $response, $args) {
        $data = ['albums' => null];

        if($request->isPost() && $search = $request->getParam('search'))
        {
            $data['albums'] = $this->albums->search($search);
        }

        return $this->renderer->render($response, 'spotify.phtml', $data);
    });

    $app->get('/album/{id}', function(Request $request, Response $response, $args) {
        $id = $args['id'];

        $album = $this->albums->getAlbum($id);

        return $this->renderer->render($response, 'album.phtml', ['album' => $album]);
    });
})->add(new BasicAuthentication(['azphp' => 'group']));


$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
