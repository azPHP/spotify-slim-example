<?php


namespace Unit\Routing;


use Slim\App;
use SpotifyApp\Routing\PowerRoute;

class PowerRouteTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function test_it_adds_route_for_power_controller()
    {
        $app = $this->getMockBuilder(App::class)
            ->disableOriginalConstructor()
            ->getMock();

        $app->expects($this->once())
            ->method('get')
            ->with(PowerRoute::ROUTE, PowerRoute::CONTROLLER);

        PowerRoute::apply($app);
    }
}
