<?php

interface Operation {
    public function calculate($a, $b);
    public function getSymbol();
}

class Add implements Operation {
    public function calculate($a, $b) { return $a + $b; }
    public function getSymbol() { return "+"; }
}

class Subtract implements Operation {
    public function calculate($a, $b) { return $a - $b; }
    public function getSymbol() { return "-"; }
}

class Multiply implements Operation {
    public function calculate($a, $b) { return $a * $b; }
    public function getSymbol() { return "*"; }
}

// Null Object - عملیاتی که هیچ کاری نمی‌کند!
class NullOperation implements Operation {
    public function calculate($a, $b) { 
        return $a;  // مقدار اول را برمی‌گرداند (اثر خنثی)
    }
    public function getSymbol() { return "(هیچ عملی)"; }
}

function findOperation($symbol) {
    switch ($symbol) {
        case '+': return new Add();
        case '-': return new Subtract();
        case '*': return new Multiply();
        default: return new NullOperation();  // به جای null
    }
}

// استفاده
$operations = ['+', '-', '*', '/', '%', '^'];

foreach ($operations as $op) {
    $operation = findOperation($op);
    $result = $operation->calculate(10, 5);
    echo "10 {$operation->getSymbol()} 5 = $result\n";
}