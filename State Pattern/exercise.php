<?php

interface TrafficLightState {
    public function change(TrafficLight $light);
    public function getColor();
}

class TrafficLight {
    private $state;
    
    public function __construct() {
        $this->state = new RedState();
    }
    
    public function setState(TrafficLightState $state) {
        $this->state = $state;
    }
    
    public function change() {
        $this->state->change($this);
    }
    
    public function getColor() {
        return $this->state->getColor();
    }
}

class RedState implements TrafficLightState {
    public function change(TrafficLight $light) {
        $light->setState(new GreenState());
    }
    
    public function getColor() {
        return "🔴 قرمز (بایستید)";
    }
}

class GreenState implements TrafficLightState {
    public function change(TrafficLight $light) {
        $light->setState(new YellowState());
    }
    
    public function getColor() {
        return "🟢 سبز (بروید)";
    }
}

class YellowState implements TrafficLightState {
    public function change(TrafficLight $light) {
        $light->setState(new RedState());
    }
    
    public function getColor() {
        return "🟡 زرد (آماده شوید)";
    }
}

// استفاده
$light = new TrafficLight();

for ($i = 0; $i < 6; $i++) {
    echo $light->getColor() . "\n";
    $light->change();
    sleep(1); // در اجرای واقعی 1 ثانیه صبر می‌کنه
}