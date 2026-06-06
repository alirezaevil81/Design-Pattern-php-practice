<?php

// مشکل: شیء تاریخ انقضا داخل کارت اعتباری
class ExpiryDate {
    public $year;
    public $month;
    
    public function __construct($year, $month) {
        $this->year = $year;
        $this->month = $month;
    }
}

class CreditCard {
    public $number;
    public $holder;
    public $expiry;  // این یک شیء است!
    
    public function __construct($number, $holder, ExpiryDate $expiry) {
        $this->number = $number;
        $this->holder = $holder;
        $this->expiry = $expiry;
    }
    
    // کپی ساده (مشکل‌دار)
    public function badCopy() {
        return clone $this;
    }
    
    // کپی درست با Prototype
    public function goodCopy() {
        $clone = clone $this;
        $clone->expiry = new ExpiryDate($this->expiry->year, $this->expiry->month);
        return $clone;
    }
    
    public function display() {
        echo "💳 {$this->number} - {$this->holder} - Expires: {$this->expiry->year}/{$this->expiry->month}\n";
    }
}

// نشان دادن مشکل
$original = new CreditCard("1234-5678", "Ali", new ExpiryDate(2025, 12));
$badCopy = $original->badCopy();

$badCopy->expiry->year = 2026;  // تغییر تاریخ در کپی

echo "اصل: " . $original->expiry->year . "\n";  // 2026 ❌ (تغییر کرده!)
echo "کپی: " . $badCopy->expiry->year . "\n";   // 2026

// راه حل درست
$goodCopy = $original->goodCopy();
$goodCopy->expiry->year = 2027;

echo "\nبا کپی درست:\n";
echo "اصل: " . $original->expiry->year . "\n";  // 2026 ✅ (تغییر نکرده)
echo "کپی: " . $goodCopy->expiry->year . "\n";  // 2027