<?php

namespace lf11\BotMan\Interfaces\Middleware;

use lf11\BotMan\BotMan;

interface Sending
{
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
    public function sending($payload, $next, BotMan $bot);
}
