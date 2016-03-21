<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Slim\App;
use Slim\Http\Environment;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Uri;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var  App */
    private $app;
    /** @var  Response */
    private $lastResponse;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->app = include __DIR__ . '/../../src/bootstrap.php';
    }

    /**
     * @When /^I call upon the power of "([^"]*)"$/
     */
    public function iCallUponThePowerOf($source)
    {
        $request = Request::createFromEnvironment(Environment::mock([]))
            ->withUri(Uri::createFromString(sprintf('/power/%s', $source)))
            ->withMethod('GET');

        $container = $this->app->getContainer();
        $container['request'] = $request;

        $this->lastResponse = $this->app->run(true);
    }

    /**
     * @Then /^the catch phrase should include "([^"]*)"$/
     */
    public function theCatchPhraseShouldInclude($source)
    {
        PHPUnit::assertContains($source,
            $this->lastResponse->getBody()->__toString(),
            "response should contain source in catch phrase");
    }
}
