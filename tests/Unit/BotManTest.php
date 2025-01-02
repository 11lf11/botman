<?php

namespace lf11\BotMan\Tests\Unit;

use lf11\BotMan\BotMan;
use lf11\BotMan\BotManFactory;
use lf11\BotMan\Cache\ArrayCache;
use lf11\BotMan\Drivers\Tests\FakeDriver;
use lf11\BotMan\Messages\Incoming\IncomingMessage;
use lf11\BotMan\Tests\Fixtures\TestConversation;
use Illuminate\Support\Collection;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class BotManTest extends TestCase
{
    protected $cache;

    protected function tearDown(): void
    {
        m::close();
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->cache = new ArrayCache();
    }

    /**
     * @param $data
     * @return BotMan
     */
    protected function getBot($data)
    {
        $botman = BotManFactory::create([], $this->cache);

        $data = Collection::make($data);
        /** @var FakeDriver $driver */
        $driver = m::mock(FakeDriver::class)->makePartial();

        $driver->isBot = $data->get('is_from_bot', false);
        $driver->messages = [new IncomingMessage($data->get('message'), $data->get('sender'), $data->get('recipient'))];

        $botman->setDriver($driver);

        return $botman;
    }

    /** @test */
    public function it_can_return_stored_questions()
    {
        $botman = $this->getBot([]);

        $botman->storeConversation(new TestConversation(), function () {
        }, 'This is my question');

        $this->assertSame('This is my question', $botman->getStoredConversationQuestion());
    }
}
