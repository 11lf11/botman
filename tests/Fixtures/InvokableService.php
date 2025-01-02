<?php

namespace lf11\BotMan\Tests\Fixtures;

class InvokableService
{
    public $invoked = false;

    public function __invoke()
    {
        $this->invoked = true;
    }
}
