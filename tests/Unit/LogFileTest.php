<?php

use PHPUnit\Framework\TestCase;

use phpcodex\Logging\Services\LogFile;


use phpcodex\Logging\Exceptions\DirectoryNotWritableException;
use phpcodex\Logging\Exceptions\DirectoryNotExistsException;

class LogFileTest extends TestCase
{
    /**
     * Test our path remains unchanged once we
     * create our log file object.
     *
     * @throws DirectoryNotExistsException
     * @throws DirectoryNotWritableException
     */
    public function test_logfile_name_remains_unchanged()
    {
        $path = __DIR__ . '/' . 'test.txt';
        $logFile = new LogFile($path);
        $logFile->destroy();
        $this->assertEquals($logFile->get(), $path);
    }

    /**
     * Test if the folder doesn't exist that we throw
     * the relevant exception.
     *
     * @throws DirectoryNotExistsException
     * @throws DirectoryNotWritableException
     */
    public function test_invalid_directory_throws()
    {
        $this->expectException(DirectoryNotExistsException::class);
        $path = __DIR__ . '/invalid/directory/test.txt';
        $logFile = new LogFile($path);
    }

    /**
     * Test if the folder is not writable, that we throw
     * the relevant exception.
     *
     * @throws DirectoryNotExistsException
     * @throws DirectoryNotWritableException
     */
    public function test_directory_not_writable_throws()
    {
        if (!is_dir(__DIR__ . '/Non-Writable')) {
            mkdir(__DIR__ . '/Non-Writable', 0555);
        }

        $this->expectException(DirectoryNotWritableException::class);
        $path = __DIR__ . '/Non-Writable/test.txt';
        $logFile = new LogFile($path);

        rmdir( __DIR__ . '/Non-Writable');
    }
}
