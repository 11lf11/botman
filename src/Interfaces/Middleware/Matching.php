<?php

namespace lf11\BotMan\Interfaces\Middleware;

use lf11\BotMan\Messages\Incoming\IncomingMessage;

interface Matching
{
    /**
     * @param IncomingMessage $message
     * @param string $pattern
     * @param bool $regexMatched Indicator if the regular expression was matched too
     * @return bool
     */
    public function matching(IncomingMessage $message, $pattern, $regexMatched);
}
