<?php

namespace lf11\BotMan\Interfaces\Middleware;

use lf11\BotMan\BotMan;
use lf11\BotMan\Messages\Incoming\IncomingMessage;

interface Heard
{
    /**
     * Handle a message that was successfully heard, but not processed yet.
     *
     * @param IncomingMessage $message
     * @param callable $next
     * @param BotMan $bot
     *
     * @return mixed
     */
    public function heard(IncomingMessage $message, $next, BotMan $bot);
}
