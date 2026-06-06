<?php

class Pizza {
    private $size;
    private $cheese;
    private $pepperoni;
    private $mushrooms;
    private $olives;
    private $sauce;
    
    public function __construct() {}
    
    public function display() {
        echo "\n🍕 پیتزای شما:\n";
        echo "اندازه: {$this->size}\n";
        echo "سس: {$this->sauce}\n";
        echo "مواد: " . implode(', ', array_filter([
            $this->cheese ? 'پنیر' : null,
            $this->pepperoni ? 'پپرونی' : null,
            $this->mushrooms ? 'قارچ' : null,
            $this->olives ? 'زیتون' : null,
        ])) . "\n";
    }
    
    public static function builder() {
        return new PizzaBuilder();
    }
    
    // Setters for Builder
    public function setSize($size) { $this->size = $size; }
    public function setCheese($cheese) { $this->cheese = $cheese; }
    public function setPepperoni($pepperoni) { $this->pepperoni = $pepperoni; }
    public function setMushrooms($mushrooms) { $this->mushrooms = $mushrooms; }
    public function setOlives($olives) { $this->olives = $olives; }
    public function setSauce($sauce) { $this->sauce = $sauce; }
}

class PizzaBuilder {
    private $pizza;
    
    public function __construct() {
        $this->pizza = new Pizza();
    }
    
    public function size($size) {
        $this->pizza->setSize($size);
        return $this;
    }
    
    public function addCheese() {
        $this->pizza->setCheese(true);
        return $this;
    }
    
    public function addPepperoni() {
        $this->pizza->setPepperoni(true);
        return $this;
    }
    
    public function addMushrooms() {
        $this->pizza->setMushrooms(true);
        return $this;
    }
    
    public function addOlives() {
        $this->pizza->setOlives(true);
        return $this;
    }
    
    public function sauce($sauce) {
        $this->pizza->setSauce($sauce);
        return $this;
    }
    
    public function build() {
        return $this->pizza;
    }
}

// استفاده
$pizza = Pizza::builder()
    ->size("بزرگ")
    ->sauce("ایتالیایی")
    ->addCheese()
    ->addPepperoni()
    ->addMushrooms()
    ->build();

$pizza->display();

$customPizza = Pizza::builder()
    ->size("متوسط")
    ->sauce("باربیکیو")
    ->addCheese()
    ->addOlives()
    ->build();

$customPizza->display();