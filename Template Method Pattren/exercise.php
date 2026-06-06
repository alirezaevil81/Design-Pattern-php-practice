<?php

// الگوی Template Method
abstract class CarBuilder {
    
    // این متد TEMPLATE METHOD هست (قالب اصلی)
    // این متد رو نباید override کرد (final)
    final public function buildCar() {
        $this->buildChassis();
        $this->installEngine();
        $this->installWheels();
        $this->paint();
        $this->addAccessories(); // هوک (میتونه خالی باشه)
        
        return "ماشین ساخته شد!\n";
    }
    
    // مرحله اجباری - کلاس فرزند باید پیاده‌سازی کنه
    abstract protected function buildChassis();
    abstract protected function installEngine();
    abstract protected function installWheels();
    abstract protected function paint();
    
    // هوک (Hook) - اختیاری، کلاس فرزند میتونه override کنه یا نکنه
    protected function addAccessories() {
        // پیش‌فرض: هیچ اکسسوری اضافه نمی‌کنه
    }
}

// کلاس ماشین معمولی
class NormalCar extends CarBuilder {
    protected function buildChassis() {
        echo "شاسی معمولی ساخته شد\n";
    }
    
    protected function installEngine() {
        echo "موتور 4 سیلندر نصب شد\n";
    }
    
    protected function installWheels() {
        echo "چرخ‌های 15 اینچ نصب شد\n";
    }
    
    protected function paint() {
        echo "رنگ سفید زده شد\n";
    }
}

// کلاس ماشین اسپورت
class SportCar extends CarBuilder {
    protected function buildChassis() {
        echo "شاسی اسپرت و سبک ساخته شد\n";
    }
    
    protected function installEngine() {
        echo "موتور 8 سیلندر توربو نصب شد\n";
    }
    
    protected function installWheels() {
        echo "چرخ‌های 19 اینچ اسپرت نصب شد\n";
    }
    
    protected function paint() {
        echo "رنگ قرمز متالیک زده شد\n";
    }
    
    // اضافه کردن اکسسوری اختصاصی
    protected function addAccessories() {
        echo "اسپویلر عقب و بال اسپرت اضافه شد\n";
    }
}

// استفاده کردن
echo "=== ساخت ماشین معمولی ===\n";
$normalCar = new NormalCar();
echo $normalCar->buildCar();

echo "\n=== ساخت ماشین اسپورت ===\n";
$sportCar = new SportCar();
echo $sportCar->buildCar();