<?php namespace App;

class Service implements IObserver
{

    protected $name;

    protected $priority;

    public function __construct($name , $priority = 0)
    {
        $this->name = $name;
        $this->priority = $priority;
    }


    public function update(IObservable $observable)
    {
        print_r("{$this->name} : {$observable->getEvent()} <br>");
    }
}