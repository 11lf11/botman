<?php

namespace lf11\BotMan\Interfaces\Middleware;

use lf11\BotMan\BotMan;
use lf11\BotMan\Messages\Incoming\IncomingMessage;

interface Received
{
    /**
     * Handle an incoming message.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function received(IncomingMessage $message, $next, BotMan $bot);
}
