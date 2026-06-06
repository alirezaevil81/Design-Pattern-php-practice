<?php

class DatabaseConnection {
    // 1. متغیر استاتیک برای نگهداری تنها نمونه‌ی کلاس
    private static ?DatabaseConnection $instance = null;

    // 2. سازنده‌ی خصوصی برای جلوگیری از ایجاد نمونه‌های جدید
    private function __construct() {
        echo "Connection to the database established! (This should only happen once)\n";
        // اینجا کد واقعی اتصال به پایگاه داده قرار می‌گیرد
        // مثال: $this->connection = new PDO(...);
    }

    // 3. متد استاتیک برای دسترسی به نمونه‌ی کلاس
    public static function getInstance(): DatabaseConnection {
        // اگر نمونه هنوز ایجاد نشده است، آن را ایجاد کن
        if (self::$instance === null) {
            self::$instance = new self(); // استفاده از new self() چون درون کلاس هستیم
        }
        // نمونه‌ی موجود را برگردان
        return self::$instance;
    }

    // متدهای دیگر برای کار با دیتابیس...
    public function query(string $sql): array {
        echo "Executing query: " . $sql . "\n";
        // اینجا منطق اجرای کوئری قرار می‌گیرد
        return ["result" => "data from query"];
    }

    // متدهای دیگر...

    // 4. جلوگیری از کلون کردن نمونه (اختیاری اما توصیه شده)
    private function __clone() {
        // مانع از کلون شدن نمونه می‌شود
    }

    // 5. جلوگیری از بازیابی نمونه از طریق unserialize (اختیاری اما توصیه شده)
    public function __wakeup() {
        // مانع از بازیابی نمونه از طریق unserialize می‌شود
        throw new \Exception("Cannot unserialize a Singleton.");
    }
}

// ----- استفاده از Singleton -----

echo "Attempting to get the first instance...\n";
// اولین بار که getInstance را صدا می‌زنیم، سازنده اجرا می‌شود
$db1 = DatabaseConnection::getInstance();
echo "First instance obtained.\n\n";

echo "Attempting to get the second instance...\n";
// بار دوم که getInstance را صدا می‌زنیم، همان نمونه‌ی قبلی برگردانده می‌شود
$db2 = DatabaseConnection::getInstance();
echo "Second instance obtained.\n\n";

// بررسی اینکه آیا هر دو متغیر به یک شیء اشاره می‌کنند
if ($db1 === $db2) {
    echo "✅ $db1 and $db2 point to the same instance.\n";
} else {
    echo "❌ $db1 and $db2 point to different instances. Something is wrong!\n";
}

// استفاده از متدهای نمونه
$result1 = $db1->query("SELECT * FROM users");
print_r($result1);

$result2 = $db2->query("INSERT INTO logs (message) VALUES ('User logged in')");
print_r($result2);

// تلاش برای ایجاد نمونه‌ی جدید به طور مستقیم (این کار خطا می‌دهد)
// $db3 = new DatabaseConnection(); // Fatal error: Uncaught Error: Call to private DatabaseConnection::__construct()

// تلاش برای کلون کردن نمونه (این کار خطا می‌دهد اگر __clone پیاده‌سازی شده باشد)
// $db4 = clone $db1; // Fatal error: Uncaught Error: Call to private DatabaseConnection::__clone()

?>
