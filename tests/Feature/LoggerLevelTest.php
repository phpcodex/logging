<?php

use PHPUnit\Framework\TestCase;

use phpcodex\Logging\Services\LogFile;
use phpcodex\Logging\Logger;

/**
 * Class LoggerTest
 */
class LoggerLevelTest extends TestCase
{
    public function setUp()
    {
        $files = [
            __DIR__ . '/test2.txt',
            __DIR__ . '/test3.txt',
            __DIR__ . '/test4.txt',
            __DIR__ . '/test5.txt',
            __DIR__ . '/test6.txt',
            __DIR__ . '/test7.txt',
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                unlink($file);
            }
        }
    }

    public function test_log_value_emerg()
    {
        $file = __DIR__ . '/test2.txt';
        $string = 'Testing emerg';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->emerg($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'EMERG');
            $this->assertEquals($line->level_value, Logger::LOG_EMERG);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

    public function test_log_value_crit()
    {
        $file = __DIR__ . '/test2.txt';
        $string = 'Testing emerg';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->crit($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'CRIT');
            $this->assertEquals($line->level_value, Logger::LOG_CRIT);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

    public function test_log_value_err()
    {
        $file = __DIR__ . '/test3.txt';
        $string = 'Testing err';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->err($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'ERR');
            $this->assertEquals($line->level_value, Logger::LOG_ERR);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

    public function test_log_value_warn()
    {
        $file = __DIR__ . '/test4.txt';
        $string = 'Testing warn';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->warn($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'WARN');
            $this->assertEquals($line->level_value, Logger::LOG_WARN);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

    public function test_log_value_notice()
    {
        $file = __DIR__ . '/test5.txt';
        $string = 'Testing notice';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->notice($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'NOTICE');
            $this->assertEquals($line->level_value, Logger::LOG_NOTICE);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

    public function test_log_value_info()
    {
        $file = __DIR__ . '/test6.txt';
        $string = 'Testing info';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->info($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'INFO');
            $this->assertEquals($line->level_value, Logger::LOG_INFO);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

    public function test_log_value_debug()
    {
        $file = __DIR__ . '/test7.txt';
        $string = 'Testing debug';

        $logFile = new LogFile($file);
        $logger = new Logger($logFile);
        $logger->debug($string);

        $lines = file($file);
        foreach ($lines as $line) {
            $line = json_decode($line);
            $this->assertEquals($line->level, 'DEBUG');
            $this->assertEquals($line->level_value, Logger::LOG_DEBUG);
            $this->assertEquals($line->message, $string);
        }

        $logFile->destroy();
    }

}
