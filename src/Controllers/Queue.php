<?php
namespace CL\Controllers;

use CL\CoffeePot\Implementations\Dummy;

class Queue
{
    protected $logger;

    protected $queue;

    /**
     * The consturctor method
     * @param CLQueueQueueInterface $queue  The queue implementation.
     * @param PsrLogLoggerInterface $logger The logger implementation
     */
    public function __construct(\CL\Queue\QueueInterface $queue, \Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->queue  = $queue;
    }

    /**
     * Send message to the queue to initiate brewing
     *
     * @return void
     */
    public function pushAction()
    {
        $task    = new \CL\Queue\Task();
        $success = $this->queue->push($task);
        if ($success) {
            $this->logger->info("Task successfully pushed to queue.");
            return "OK";
        }
        $this->logger->error("Task creation failed.");
        return "FAIL";
    }
}
