<?php

namespace lf11\BotMan\Tests\Fixtures;

use lf11\BotMan\BotMan;
use Illuminate\Http\Request;

class TestController
{
    public function __construct(Request $request)
    {
        $_SERVER['autowiring'] = true;
    }

    public function handle(BotMan $bot)
    {
    }
}
