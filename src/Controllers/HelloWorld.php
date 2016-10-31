<?php
namespace CL\Controllers;

use CL\CoffeePot\Implementations\Led;

class HelloWorld
{
    protected $logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function indexAction()
    {
        $this->logger->info(__METHOD__ . " Entering method");
        $coffeePot = new Led();
        $coffeePot->brewStart();
        sleep(5);
        $coffeePot->brewStop();

        return "Enjoy your coffee!";
    }

    /**
     * Send message to the queue to initiate brewing
     *
     * @return void
     */
    public function queueAction(\CL\Queue\QueueInterface $queue)
    {
        $task    = new \CL\Queue\Task();
        $success = $queue->push($task);
        if ($success) {
            return "OK";
        }
        return "FAIL";
    }
}
