<?php
namespace CL\Controllers;

use CL\CoffeePot\Implementations\Dummy;

class Queue
{
    protected $logger;

    protected $queue;

    protected $twig;

    /**
     * The consturctor method
     * @param CLQueueQueueInterface $queue  The queue implementation.
     * @param PsrLogLoggerInterface $logger The logger implementation
     */
    public function __construct(
        \CL\Queue\QueueInterface $queue,
        \Psr\Log\LoggerInterface $logger,
        $twig
    ) {
        $this->logger = $logger;
        $this->queue  = $queue;
        $this->twig   = $twig;
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
            return $this->twig->render('queue.twig', ['status' => 'OK']);
        }
        $this->logger->error("Task creation failed.");
        return $this->twig->render('queue.twig', ['status' => 'FAIL']);
    }
}
