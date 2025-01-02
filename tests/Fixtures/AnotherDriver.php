<?php

namespace lf11\BotMan\Tests\Fixtures;

class AnotherDriver extends TestDriver
{
    /**
     * Return the driver name.
     *
     * @return string
     */
    public function getName()
    {
        return 'Another';
    }
}
