<?php

namespace phpcodex\Logging\Services;

/**
 * Class LogLevel
 * @package phpcodex\Logging\Services
 */
class LogLevel
{

    const LOG_EMERG     = 0;
    const LOG_ALERT     = 1;
    const LOG_CRIT      = 2;
    const LOG_ERR       = 3;
    const LOG_WARN      = 4;
    const LOG_NOTICE    = 5;
    const LOG_INFO      = 6;
    const LOG_DEBUG     = 7;

    public function emerg(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'EMERG', 'level_value' => self::LOG_EMERG]);
    }

    public function alert(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'ALERT', 'level_value' => self::LOG_ALERT]);
    }

    public function crit(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'CRIT', 'level_value' => self::LOG_CRIT]);
    }

    public function err(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'ERR', 'level_value' => self::LOG_ERR]);
    }

    public function warn(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'WARN', 'level_value' => self::LOG_WARN]);
    }

    public function notice(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'NOTICE', 'level_value' => self::LOG_NOTICE]);
    }

    public function info(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'INFO', 'level_value' => self::LOG_INFO]);
    }

    public function debug(string $message) : bool
    {
        return $this->log(['message' => $message, 'level' => 'DEBUG', 'level_value' => self::LOG_DEBUG]);
    }

}
