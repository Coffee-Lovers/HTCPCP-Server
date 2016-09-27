<?php
namespace CL\Controllers;

class Queue
{
    /** @var \Psr\Log\LoggerInterface  */
    protected $logger;

    /** @var \CLLibs\Queue\Queue  */
    protected $queue;

    /** @var \Twig_Environment  */
    protected $twig;

    /**
     * The consturctor method
     * @param \CLLibs\Queue\Queue      $queue  The queue implementation.
     * @param \Psr\Log\LoggerInterface $logger The logger implementation
     * @param \Twig_Environment        $twig   The twig compiler
     */
    public function __construct(
        \CLLibs\Queue\Queue $queue,
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
     * @return string
     */
    public function pushAction()
    {
        $task    = new \CLLibs\Queue\Task();
        $success = $this->queue->push($task, 'task_queue');
        if ($success) {
            $this->logger->info("Task successfully pushed to queue.");
            return $this->twig->render('queue.twig', ['status' => 'OK']);
        }
        $this->logger->error("Task creation failed.");
        return $this->twig->render('queue.twig', ['status' => 'FAIL']);
    }
}
