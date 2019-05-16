<?php

namespace tests\unit;

use alexeevdv\psr\StringLogger;
use Codeception\Test\Unit;

class StringLoggerTest extends Unit
{
    public function testLogging()
    {
        $logger = new StringLogger;
        $logger->info('Message {text}', ['text' => 'test']);
        $logger->error('Hello world {date}', ['date' => '2019-01-01 00:00:00']);
        $expectedText = 'Message test' . PHP_EOL;
        $expectedText.= 'Hello world 2019-01-01 00:00:00';
        $this->assertEquals($expectedText, $logger->getText());
    }
}
