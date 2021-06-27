<?php

namespace App\Common\Loggers;

use Monolog\Logger;

class MySQLCustomLogger
{
    /**
     * Create a custom Monolog instance.
     *
     *
     * @param  array  $config
     * @return \Monolog\Logger
     */
    public function __invoke(array $config)
    {
        $logger = new Logger('MySQLLoggingHandler');

        return $logger->pushHandler(new MySQLLoggingHandler());
    }
}
