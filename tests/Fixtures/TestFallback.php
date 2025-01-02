<?php

namespace lf11\BotMan\Tests\Fixtures;

use lf11\BotMan\BotMan;

class TestFallback
{
    public static $called = false;

    public function foo(BotMan $bot)
    {
        self::$called = true;
    }
}
