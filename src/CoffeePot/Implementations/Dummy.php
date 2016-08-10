<?php
namespace CL\CoffeePot\Implementations;

use CL\CoffeePot\CoffeePot;

class Dummy implements CoffeePot
{

    /**
     * Start brewing coffee
     *
     * @return void
     */
    public function brewStart()
    {
        echo "Brewing...";
    }

    /**
     * Stop brewing coffee
     *
     * @return void
     */
    public function brewStop()
    {
        echo " done.\n";
    }

    /**
     * Get current water/coffee temperature
     *
     * @return float
     */
    public function getTemperature()
    {
        return mt_rand(0, 100);
    }

    /**
     * Start pouring coffee
     *
     * @return void
     */
    public function pourCoffeeStart()
    {
        echo "Pouring coffee...";
    }

    /**
     * Stop pouring coffee
     *
     * @return void
     */
    public function pourCoffeeStop()
    {
        echo " done.\n";
    }

    /**
     * Start pouring milk
     *
     * @return void
     */
    public function pourMilkStart()
    {
        echo "Pouring milk...";
    }

    /**
     * Stop pouring milk
     *
     * @return void
     */
    public function pourMilkStop()
    {
        echo " done.\n";
    }
}