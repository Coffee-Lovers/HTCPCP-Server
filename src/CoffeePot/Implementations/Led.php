<?php
namespace CL\CoffeePot\Implementations;

use CL\CoffeePot\CoffeePot;
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\OutputPinInterface;
use PiPHP\GPIO\Pin\PinInterface;

class Led implements CoffeePot
{

    const LED_PIN = 18;

    /** @var  OutputPinInterface */
    private $ledPin;

    public function __construct()
    {
        $gpio = new GPIO();
        $this->ledPin = $gpio->getOutputPin(self::LED_PIN);
    }

    /**
     * Start brewing coffee
     *
     * @return void
     */
    public function brewStart()
    {
        $this->ledOn();
    }

    /**
     * Stop brewing coffee
     *
     * @return void
     */
    public function brewStop()
    {
        $this->ledOff();
    }

    /**
     * Get current water/coffee temperature
     *
     * @return float
     */
    public function getTemperature()
    {
        //no-op
    }

    /**
     * Start pouring coffee
     *
     * @return void
     */
    public function pourCoffeeStart()
    {
        //no-op
    }

    /**
     * Stop pouring coffee
     *
     * @return void
     */
    public function pourCoffeeStop()
    {
        //no-op
    }

    /**
     * Start pouring milk
     *
     * @return void
     */
    public function pourMilkStart()
    {
        //no-op
    }

    /**
     * Stop pouring milk
     *
     * @return void
     */
    public function pourMilkStop()
    {
        //no-op
    }

    /**
     * Turn the LED on
     *
     * @return void
     */
    private function ledOn()
    {
        $this->ledPin->setValue(PinInterface::VALUE_HIGH);
    }

    /**
     * Turn the LED off
     *
     * @return void
     */
    private function ledOff()
    {
        $this->ledPin->setValue(PinInterface::VALUE_LOW);
    }
}