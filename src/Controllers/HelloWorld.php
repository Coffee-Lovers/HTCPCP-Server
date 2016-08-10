<?php
namespace CL\Controllers;

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
        return "Hello from " . __METHOD__;
    }
}
