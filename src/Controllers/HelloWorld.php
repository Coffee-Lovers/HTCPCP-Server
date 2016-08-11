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
}
