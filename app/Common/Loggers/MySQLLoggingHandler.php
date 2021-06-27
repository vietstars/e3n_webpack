<?php

namespace App\Common\Loggers;

use App\Models\SystemLog;
use ErrorException;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;

class MySQLLoggingHandler extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        $userId = 'system';
        $userEmail = 'system';

        if (! empty(Auth::id())) {
            $userId = Auth::id();
            $userEmail = optional(Auth::user())->email;
        }

        SystemLog::create([
            'env' => app()->environment(),
            'is_console' => app()->runningInConsole(),
            'message' => $record['message'],
            'level' => $record['level'],
            'level_name' => $record['level_name'],
            'formatted' => $record['formatted'],
            'context' => $this->getContext($record),
            'extra' => json_encode($record['extra']),
            'user_id' => $userId,
            'user_email' => $userEmail,
            'request_url' => request()->getUri(),
            'request_method' => request()->method(),
            'input_param' => json_encode(request()->all()),
            'remote_addr' => isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : null,
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : null,
            'created_at' => now(),
        ]);
    }

    protected function getContext($record)
    {
        $context = $record['context'];

        if (isset($context['exception']) && $context['exception'] instanceof ErrorException) {
            $context['trace'] = $record['context']['exception']->getTrace();
        }

        return json_encode($context);
    }
}
