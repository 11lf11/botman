<?php

namespace lf11\BotMan\Tests;

use lf11\BotMan\BotManFactory;
use lf11\BotMan\Drivers\DriverManager;
use lf11\BotMan\Drivers\HttpDriver;
use lf11\BotMan\Interfaces\UserInterface;
use lf11\BotMan\Interfaces\VerifiesService;
use lf11\BotMan\Messages\Incoming\Answer;
use lf11\BotMan\Messages\Incoming\IncomingMessage;
use lf11\BotMan\Tests\Fixtures\TestDriver;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class VerifiesServicesTest.
 */
class VerifiesServicesTest extends TestCase
{
    /** @test */
    public function it_can_verify_drivers()
    {
        $this->assertFalse(isset($_SERVER['driver_verified']));

        DriverManager::loadDriver(DummyDriver::class);

        $botman = BotManFactory::create([]);
        $botman->listen();

        $this->assertTrue($_SERVER['driver_verified']);
    }

    /** @test */
    public function it_can_only_verify_http_drivers()
    {
        $this->assertFalse(isset($_SERVER['verifiedTestDriver']));

        DriverManager::loadDriver(TestDriver::class);

        $botman = BotManFactory::create([]);
        $botman->listen();

        $this->assertFalse(isset($_SERVER['verifiedTestDriver']));
    }
}

class DummyDriver extends HttpDriver implements VerifiesService
{
    /**
     * Determine if the request is for this driver.
     *
     * @return bool
     */
    public function matchesRequest()
    {
        return true;
    }

    /**
     * Retrieve the chat message(s).
     *
     * @return array
     */
    public function getMessages()
    {
        return [new IncomingMessage('', '', '')];
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return true;
    }

    /**
     * Retrieve User information.
     * @param IncomingMessage $matchingMessage
     * @return UserInterface
     */
    public function getUser(IncomingMessage $matchingMessage)
    {
    }

    /**
     * @param IncomingMessage $message
     * @return \lf11\BotMan\Messages\Incoming\Answer
     */
    public function getConversationAnswer(IncomingMessage $message)
    {
        return new Answer('');
    }

    /**
     * @param string|\lf11\BotMan\Messages\Outgoing\Question $message
     * @param IncomingMessage $matchingMessage
     * @param array $additionalParameters
     * @return $this
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
    }

    /**
     * @param mixed $payload
     * @return Response
     */
    public function sendPayload($payload)
    {
    }

    /**
     * @param Request $request
     * @return void
     */
    public function buildPayload(Request $request)
    {
    }

    /**
     * Low-level method to perform driver specific API requests.
     *
     * @param string $endpoint
     * @param array $parameters
     * @param \lf11\BotMan\Messages\Incoming\IncomingMessage $matchingMessage
     * @return void
     */
    public function sendRequest($endpoint, array $parameters, IncomingMessage $matchingMessage)
    {
    }

    public function verifyRequest(Request $request)
    {
        $_SERVER['driver_verified'] = true;
    }
}
