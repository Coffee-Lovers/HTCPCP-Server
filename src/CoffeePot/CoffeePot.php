<?php
namespace CL\CoffeePot;

interface CoffeePot
{

    /**
     * Start brewing coffee
     *
     * @return void
     */
    public function brewStart();

    /**
     * Stop brewing coffee
     *
     * @return void
     */
    public function brewStop();

    /**
     * Get current water/coffee temperature
     *
     * @return float
     */
    public function getTemperature();

    /**
     * Start pouring coffee
     *
     * @return void
     */
    public function pourCoffeeStart();

    /**
     * Stop pouring coffee
     *
     * @return void
     */
    public function pourCoffeeStop();

    /**
     * Start pouring milk
     *
     * @return void
     */
    public function pourMilkStart();

    /**
     * Stop pouring milk
     *
     * @return void
     */
    public function pourMilkStop();

}