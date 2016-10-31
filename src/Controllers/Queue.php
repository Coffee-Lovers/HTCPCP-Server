<?php
namespace CL\Controllers;

use CLLibs\Messaging\CoffeePotProgressMessage;

class Queue
{
    /** @var \Psr\Log\LoggerInterface  */
    protected $logger;

    /** @var \CLLibs\Queue\Queue  */
    protected $queue;

    /** @var \Twig_Environment  */
    protected $twig;
    /**
     * @var \CLLibs\Messaging\Hub
     */
    private $hub;

    /**
     * The consturctor method
     * @param \CLLibs\Queue\Queue $queue The queue implementation.
     * @param \CLLibs\Messaging\Hub $hub The messaging hub.
     * @param \Psr\Log\LoggerInterface $logger The logger implementation
     * @param \Twig_Environment $twig The twig compiler
     */
    public function __construct(
        \CLLibs\Queue\Queue $queue,
        \CLLibs\Messaging\Hub $hub,
        \Psr\Log\LoggerInterface $logger,
        $twig
    ) {
        $this->logger = $logger;
        $this->queue  = $queue;
        $this->twig   = $twig;
        $this->hub    = $hub;
    }

    /**
     * Send message to the queue to initiate brewing
     *
     * @return string
     */
    public function pushAction()
    {
        $task = new \CLLibs\Queue\Task();
        $this->hub->publish(new CoffeePotProgressMessage($task->getId(), CoffeePotProgressMessage::STAGE_PENDING));
        $success = $this->queue->push($task, 'task_queue');

        if ($success) {
            $this->logger->info("Task successfully pushed to queue.");
            return $this->twig->render('queue.twig', ['status' => 'OK', 'taskID' => $task->getId()]);
        }

        $this->logger->error("Task creation failed.");
        $this->hub->publish(new CoffeePotProgressMessage($task->getId(), CoffeePotProgressMessage::STAGE_FAILED));
        return $this->twig->render('queue.twig', ['status' => 'FAIL', 'taskID' => $task->getId()]);
    }
}
