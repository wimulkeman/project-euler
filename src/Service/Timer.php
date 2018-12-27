<?php
/**
 * Created by IntelliJ IDEA.
 * User: wimulkeman
 * Date: 2018-12-27
 * Time: 15:42
 */

namespace App\Service;


use App\DataTransformer\BytesToAReadableFormat;
use App\DataTransformer\MicrosecondsToReadableTime;

class Timer
{
    /** @var array */
    private $timers = [];

    /** @var MicrosecondsToReadableTime */
    private $readableTimeTransformer;
    /** @var BytesToAReadableFormat */
    private $readableMemoryTransformer;

    public function __construct()
    {
        $this->readableTimeTransformer = new MicrosecondsToReadableTime();
        $this->readableMemoryTransformer = new BytesToAReadableFormat();
    }

    public function startTimer(string $timerName = 'default'): void
    {
        $this->timers[$timerName] = [];
        $actionArray = &$this->timers[$timerName];

        // Log the starting time
        $actionArray['time_start'] = \microtime(true);

        // Keep track of the current used memory
        $actionArray['mem_start'] = (int) \memory_get_usage(true);
        $actionArray['mem_emalloc_start'] = (int) \memory_get_usage(false);

        // Sort by the array keys for more convenient reading
        $debugTracer = \debug_backtrace();
        if (!empty($debugTracer[1])) {
            $logCaller = $debugTracer[1];
            $logCaller['line'] = $debugTracer[0]['line'];
            $debugLogTimeArray[$timerName]['start_location'] = "{$logCaller['class']}::{$logCaller['function']}::{$logCaller['line']}";
        }

        // Sort by the array keys for more convenient reading
        \ksort($actionArray);
    }

    public function stopTimer(string $timerName = 'default'): float
    {
        if (empty($this->timers[$timerName]['time_start'])) {
            throw new \LogicException("No timer was start with the name $timerName. Available timers are: ".\implode(', ', \array_keys($this->timers)));
        }
        $actionArray = &$this->timers[$timerName];

        // Log the finish time
        $actionArray['time_stop'] = \microtime(true);
        // Calculate the time elapsed
        $actionArray['time_elapsed'] = $this->readableTimeTransformer
            ->transform($actionArray['time_stop'] - $actionArray['time_start']);

        // Calculate the used memory
        $actionArray['mem_stop'] = (int) \memory_get_usage(true);
        $actionArray['mem_emalloc_stop'] = (int) \memory_get_usage(false);

        $actionArray['mem_usage'] = $this->readableMemoryTransformer
            ->transform($actionArray['mem_stop'] - $actionArray['mem_start']);
        $actionArray['mem_emalloc_usage'] = $this->readableMemoryTransformer
            ->transform($actionArray['mem_emalloc_stop'] - $actionArray['mem_emalloc_start']);

        // Document where the timers where placed in the code
        $debugTracer = \debug_backtrace();
        if (!empty($debugTracer[1])) {
            $logCaller = $debugTracer[1];
            $logCaller['line'] = $debugTracer[0]['line'];
            $actionArray['stop_location'] = "{$logCaller['class']}::{$logCaller['function']}::{$logCaller['line']}";
        }

        // Sort by the array keys for more convenient reading
        \ksort($actionArray);

        return $actionArray['time_elapsed'];
    }

    public function getTimer($timerName = ''): array
    {
        if (empty($timerName)) {
            return $this->timers;
        }

        if (empty($this->timers[$timerName])) {
            throw new \LogicException("No timer was start with the name $timerName. Available timers are: ".\implode(', ', \array_keys($this->timers)));
        }

        return $this->timers[$timerName];
    }
}