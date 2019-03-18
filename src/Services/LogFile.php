<?php

namespace phpcodex\Logging\Services;


use phpcodex\Logging\Exceptions\DirectoryNotExistsException;
use phpcodex\Logging\Exceptions\DirectoryNotWritableException;

class LogFile
{
    protected $logFile;

    public function __construct(string $LogFile)
    {
        $this->logFile = $LogFile;

        $pathData = pathinfo($this->logFile);

        if (!is_dir($pathData['dirname'])) {
            throw new DirectoryNotExistsException($pathData['dirname']);
        }

        if (!is_writable($pathData['dirname'])) {
            throw new DirectoryNotWritableException($pathData['dirname']);
        }

        if (!file_exists($pathData['dirname'] . '/' . $pathData['basename'])) {
            fopen($pathData['dirname'] . '/' . $pathData['basename'], 'w');
        }
    }

    public function get() : string
    {
        return $this->logFile;
    }

    public function create() : bool
    {
        if (!file_exists($this->get())) {
            fopen($this->get(), 'w');
            return true;
        }

        return false;
    }

    public function destroy() : bool
    {
        if (file_exists($this->get())) {
            unlink($this->get());
            return true;
        }

        return false;
    }
}
