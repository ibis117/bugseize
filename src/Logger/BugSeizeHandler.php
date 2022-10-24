<?php

namespace Ibis117\Bugseize\Logger;

use Ibis117\Bugseize\Bugseize;
use Monolog\Handler\AbstractProcessingHandler;
use Monolog\Logger;
use Throwable;

class BugSeizeHandler extends AbstractProcessingHandler
{

    /**
     * @var Bugseize
     */
    protected $bugseize;

    public function __construct(Bugseize $bugseize, $level = Logger::DEBUG, bool $bubble = true)
    {
        $this->bugseize = $bugseize;
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        if (isset($record['context']['exception']) && $record['context']['exception'] instanceof Throwable) {
            $this->bugseize->handle(
                $record['context']['exception']
            );
            return;
        }
    }
}
