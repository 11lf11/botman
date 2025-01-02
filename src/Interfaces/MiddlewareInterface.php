<?php

namespace lf11\BotMan\Interfaces;

use lf11\BotMan\Interfaces\Middleware\Captured;
use lf11\BotMan\Interfaces\Middleware\Heard;
use lf11\BotMan\Interfaces\Middleware\Matching;
use lf11\BotMan\Interfaces\Middleware\Received;
use lf11\BotMan\Interfaces\Middleware\Sending;

interface MiddlewareInterface extends Captured, Received, Matching, Heard, Sending
{
    //
}
