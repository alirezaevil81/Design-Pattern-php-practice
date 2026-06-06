<?php

interface Coffee
{
    public function getCost();
    public function getDescription();
}

class SimpleCoffee implements Coffee
{
    public function getCost()
    {
        return 10;
    }

    public function getDescription()
    {
        return "Simple coffee";
    }
}

class MilkDecorator implements Coffee
{
    protected $coffee;

    public function __construct($coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 2;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ", with milk";
    }
}

class SugarDecorator implements Coffee  
{
    protected $coffee;

    public function __construct($coffee)
    {
        $this->coffee = $coffee;
    }

    public function getCost()
    {
        return $this->coffee->getCost() + 1;
    }

    public function getDescription()
    {
        return $this->coffee->getDescription() . ", with sugar";
    }
}       

// Usage
$coffee = new SimpleCoffee();
echo $coffee->getDescription() . " costs $" . $coffee->getCost() . "\n";

$coffee = new MilkDecorator($coffee);
echo $coffee->getDescription() . " costs $" . $coffee->getCost() . "\n";

$coffee = new SugarDecorator($coffee);
echo $coffee->getDescription() . " costs $" . $coffee->getCost() . "\n";