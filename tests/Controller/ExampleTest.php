<?php


namespace Unit\Controller;


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Response;
use SpotifyApp\Controller\Example;

class ExampleTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_invoke_response_contains_catch_phrase_with_source_from_route_placeholder()
    {
        $request = $this->getMock(RequestInterface::class);
        $response = new Response;
        $controller = new Example;

        /** @var ResponseInterface $result */
        $result = $controller($request, $response, ['placeholder' => $source = 'foobar']);
        static::assertContains(sprintf(Example::CATCH_PHRASE_PATTERN, $source),
            $result->getBody()->__toString());
    }
}
