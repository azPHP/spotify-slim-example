<?php


namespace SpotifyApp\Controller;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class Example
{
    public function __invoke(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $response->getBody()->write(sprintf("By the power of <b>%s</b>, I have the power!!!", $args['placeholder']));
        return $response;
    }

    public function foo(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $response->getBody()->write(sprintf("foo <i>%s</i>", $args['placeholder']));
        return $response;
    }

    public function l33t(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $message = str_replace(['a','e','i','o','s'], [4,3,1,0,5], $args['placeholder']);
        $response->getBody()->write($message);
        return $response;
    }

    public function bar(RequestInterface $request, ResponseInterface $response, $args = [])
    {
        $response->getBody()->write(sprintf("bar <i>%s</i>", $args['placeholder']));
        return $response;
    }
}