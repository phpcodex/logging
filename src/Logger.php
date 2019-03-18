<?php

namespace phpcodex\Logging;

use phpcodex\Logging\Services\LogFile;
use phpcodex\Logging\Services\LogLevel;

/**
 * Class Logger
 * @package phpcodex\Logging
 */
class Logger extends LogLevel
{

    protected $logFile;
    protected $resource;

    const DATE_FORMAT   = 'c';
    const VERSION       = '1';

    /**
     * Logger constructor.
     * @param LogFile $logFile
     */
	public function __construct(LogFile $logFile)
	{
	    $this->logFile = $logFile;
	}

    /**
     * The forced fields which should exist on all log
     * message levels.
     *
     * @return array
     */
	public function mandatoryFields()
    {
        return [
            '@timestamp'    => date(self::DATE_FORMAT),
            '@version'      => self::VERSION,
        ];
    }

    /**
     * Log our Key-Value-Pair data
     *
     * @param array $data
     * @return bool
     */
	public function log(array $data) : bool
    {
        if (empty($this->resource) && !is_resource($this->resource)) {
            $this->resource = fopen($this->logFile->get(), 'a');
        }

        $data = array_merge($data, $this->mandatoryFields());

        return fwrite($this->resource, json_encode($data) . PHP_EOL) ? true : false;
    }

    public static function registerErrorHandler(Logger $logger, $continueNativeHandler = false)
    {

        $previous = set_error_handler(function ($level, $message, $file, $line) use ($logger, $continueNativeHandler) {
            $iniLevel = error_reporting();

            if ($iniLevel & $level) {
                $logger->log([
                    'message'       => $message,
                    'errno'         => $level,
                    'file'          => $file,
                    'line'          => $line,
                    'level'         => 'INFO',
                    'level_value'   => self::LOG_INFO
                ]);
            }

            return !$continueNativeHandler;
        });

        return $previous;
    }

    /**
     * Ensure that if we have an open resource,
     * we close this, because we're tidy.
     */
    public function __destruct()
    {
        if (!empty($this->resource) && is_resource($this->resource)) {
            fclose($this->resource);
        }
    }
}
