<?php

namespace lf11\BotMan\Tests\Fixtures;

use lf11\BotMan\Drivers\HttpDriver;
use lf11\BotMan\Messages\Incoming\Answer;
use lf11\BotMan\Messages\Incoming\IncomingMessage;
use lf11\BotMan\Messages\Outgoing\Question;
use lf11\BotMan\Users\User;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class TestAdditionalDriver extends HttpDriver
{
    /** @var ParameterBag */
    protected $data;
    /** @var Collection */
    protected $event;

    /**
     * Determine if the request is for this driver.
     *
     * @return bool
     */
    public function matchesRequest()
    {
        return $this->data->has('additional');
    }

    /**
     * Retrieve the chat message(s).
     *
     * @return array
     */
    public function getMessages()
    {
        $messageText = $this->event->get('text');

        return [new IncomingMessage($messageText, 0, 0, $this->event)];
    }

    /**
     * @return bool
     */
    public function isBot()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isConfigured()
    {
        return true;
    }

    /**
     * @param IncomingMessage $matchingMessage
     *
     * @return Answer
     */
    public function getConversationAnswer(IncomingMessage $message)
    {
        return Answer::create();
    }

    /**
     * @param string|Question $message
     * @param \lf11\BotMan\Messages\Incoming\IncomingMessage $matchingMessage
     * @param array $additionalParameters
     * @return mixed
     */
    public function buildServicePayload($message, $matchingMessage, $additionalParameters = [])
    {
        return [];
    }

    /**
     * @param mixed $payload
     * @return mixed
     */
    public function sendPayload($payload)
    {
        return $this;
    }

    /**
     * @param \lf11\BotMan\Messages\Incoming\IncomingMessage $matchingMessage
     * @return string
     */
    public function types(IncomingMessage $matchingMessage)
    {
    }

    /**
     * @return bool
     */
    public function hasMatchingEvent()
    {
        return false;
    }

    /**
     * Return the driver name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Test';
    }

    public function dummyMethod()
    {
    }

    /**
     * Retrieve User information.
     * @param \lf11\BotMan\Messages\Incoming\IncomingMessage $matchingMessage
     * @return UserInterface
     */
    public function getUser(IncomingMessage $matchingMessage)
    {
        return new User();
    }

    /**
     * Tells if the stored conversation callbacks are serialized.
     *
     * @return bool
     */
    public function serializesCallbacks()
    {
        return false;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function buildPayload(Request $request)
    {
        $this->data = new ParameterBag((array) json_decode($request->getContent(), true));
        $this->event = Collection::make($request->request->all());
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
        // TODO: Implement sendRequest() method.
    }
}
