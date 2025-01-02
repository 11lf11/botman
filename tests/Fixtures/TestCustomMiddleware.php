<?php

namespace lf11\BotMan\Tests\Fixtures;

use lf11\BotMan\BotMan;
use lf11\BotMan\Interfaces\MiddlewareInterface;
use lf11\BotMan\Messages\Incoming\IncomingMessage;
use lf11\BotMan\Messages\Outgoing\Question;

class TestCustomMiddleware implements MiddlewareInterface
{
    /**
     * Handle a captured message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function captured(IncomingMessage $message, $next, BotMan $bot)
    {
        $_SERVER['middleware_captured'] = $message->getText();
        $conversation = $bot->getStoredConversation($message);
        /** @var Question $question */
        $question = unserialize($conversation['question']);
        $_SERVER['middleware_captured_question'] = $question;

        return $next($message);
    }

    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMan $bot)
    {
        $_SERVER['middleware_received_count'] = isset($_SERVER['middleware_received_count']) ? $_SERVER['middleware_received_count'] + 1 : 1;
        $_SERVER['middleware_received'] = $message->getText();

        return $next($message);
    }

    /**
     * @param \lf11\BotMan\Messages\Incoming\IncomingMessage $message
     * @param string $pattern
     * @param bool $regexMatched Indicator if the regular expression was matched too
     * @return bool
     */
    public function matching(IncomingMessage $message, $pattern, $regexMatched)
    {
        $_SERVER['middleware_matching'] = $message->getText().'-'.$pattern;

        return $regexMatched;
    }

    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMan $bot)
    {
        $_SERVER['middleware_heard_count'] = isset($_SERVER['middleware_heard_count']) ? $_SERVER['middleware_heard_count'] + 1 : 1;

        return $next($message);
    }

    /**
     * Handle an outgoing message payload before/after it
     * hits the message service.
     *
     * @param mixed $payload
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function sending($payload, $next, BotMan $bot)
    {
        $_SERVER['middleware_sending_outgoing'] = $bot->getOutgoingMessage();
        $text = $payload->getText();
        $payload->text($text.' - middleware');
        $response = $next($payload);
        $content = $response->getContent();
        $response->setContent($content.' - sending');

        return $response;
    }
}
