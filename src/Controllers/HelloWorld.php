<?php
namespace CL\Controllers;

use CL\CoffeePot\Implementations\Dummy;

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
        $coffeePot = new Dummy();
        $coffeePot->brewStart();
        $coffeePot->brewStop();
        $coffeePot->pourCoffeeStart();
        $coffeePot->pourCoffeeStop();
        $coffeePot->pourMilkStart();
        $coffeePot->pourMilkStop();

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
