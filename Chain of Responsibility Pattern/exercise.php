<?php

interface SupportHandler {
    public function setNext(SupportHandler $handler);
    public function handle($ticket);
}

class Ticket {
    public $level;
    public $description;
    
    public function __construct($level, $description) {
        $this->level = $level;
        $this->description = $description;
    }
}

abstract class AbstractSupportHandler implements SupportHandler {
    private $nextHandler;
    
    public function setNext(SupportHandler $handler) {
        $this->nextHandler = $handler;
        return $handler;
    }
    
    public function handle($ticket) {
        if ($ticket->level <= $this->getMaxLevel()) {
            return $this->resolve($ticket);
        }
        
        if ($this->nextHandler) {
            return $this->nextHandler->handle($ticket);
        }
        
        return "❌ تیکت سطح {$ticket->level} قابل حل نیست!";
    }
    
    protected abstract function getMaxLevel();
    protected abstract function resolve($ticket);
}

// سطح 1: پشتیبانی معمولی
class Level1Support extends AbstractSupportHandler {
    protected function getMaxLevel() {
        return 1;
    }
    
    protected function resolve($ticket) {
        return "🔰 پشتیبانی سطح 1: تیکت '{$ticket->description}' حل شد";
    }
}

// سطح 2: پشتیبانی فنی
class Level2Support extends AbstractSupportHandler {
    protected function getMaxLevel() {
        return 2;
    }
    
    protected function resolve($ticket) {
        return "⚙️ پشتیبانی سطح 2: تیکت '{$ticket->description}' حل شد";
    }
}

// سطح 3: تیم توسعه
class Level3Support extends AbstractSupportHandler {
    protected function getMaxLevel() {
        return 3;
    }
    
    protected function resolve($ticket) {
        return "💻 تیم توسعه: تیکت '{$ticket->description}' حل شد";
    }
}

// استفاده
$level1 = new Level1Support();
$level2 = new Level2Support();
$level3 = new Level3Support();

$level1->setNext($level2)->setNext($level3);

$tickets = [
    new Ticket(1, "رمز عبور را فراموش کردم"),
    new Ticket(2, "نرم‌افزار کرش می‌کند"),
    new Ticket(3, "باگ در سیستم پرداخت"),
    new Ticket(4, "مشکل امنیتی جدید"),
];

foreach ($tickets as $ticket) {
    echo $level1->handle($ticket) . "\n";
}