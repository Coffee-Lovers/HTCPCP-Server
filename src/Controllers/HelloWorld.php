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
}
