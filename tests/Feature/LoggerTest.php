<?php

use PHPUnit\Framework\TestCase;

use phpcodex\Logging\Services\LogFile;
use phpcodex\Logging\Logger;

use phpcodex\Logging\Exceptions\DirectoryNotExistsException;
use phpcodex\Logging\Exceptions\DirectoryNotWritableException;

/**
 * Class LoggerTest
 */
class LoggerTest extends TestCase
{
    public function setUp()
    {
        $files = [
            __DIR__ . '/test1.txt',
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    /**
     * We want to test if we can write a log message to the output
     * file and have the contents in as exactly expected.
     *
     * @throws DirectoryNotExistsException
     * @throws DirectoryNotWritableException
     */
    public function test_we_can_log()
    {
        $data = ['message' => 'This is a message'];

        $logFile = new LogFile(__DIR__ . '/test1.txt');
        $logger = new Logger($logFile);
        $logger->log($data);

        $data = array_merge($data, [
            '@timestamp'    => date(Logger::DATE_FORMAT),
            '@version'      => Logger::VERSION,
        ]);

        $expected = json_encode($data) . PHP_EOL;
        $this->assertEquals(file_get_contents(__DIR__ . '/test1.txt'), $expected);
        $logFile->destroy();
    }
}
