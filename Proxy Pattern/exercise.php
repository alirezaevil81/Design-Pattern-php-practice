<?php

// 1. Subject interface (مشترک بین RealSubject و Proxy)
interface UserDataInterface {
    public function loadUserData($userId);
}

// 2. RealSubject (کلاس اصلی که کار واقعی را انجام می‌دهد)
class RealUserData implements UserDataInterface {
    public function loadUserData($userId) {
        // شبیه‌سازی دریافت از دیتابیس
        echo "Fetching data from DATABASE for user $userId...\n";
        return [
            'id' => $userId,
            'name' => "User $userId",
            'email' => "user$userId@example.com",
            'role' => 'user'
        ];
    }
}

// 3. Proxy (کنترل دسترسی و کش کردن)
class UserDataProxy implements UserDataInterface {
    private $realService;
    private $cache = [];
    private $currentUserRole;

    public function __construct($currentUserRole) {
        $this->realService = new RealUserData();
        $this->currentUserRole = $currentUserRole;
    }

    public function loadUserData($userId) {
        // بررسی دسترسی
        if ($this->currentUserRole !== 'admin') {
            echo "Access denied: only admin can load user data.\n";
            return null;
        }

        // بررسی کش
        if (isset($this->cache[$userId])) {
            echo "Returning CACHED data for user $userId...\n";
            return $this->cache[$userId];
        }

        // در غیر این صورت از کلاس اصلی می‌گیریم
        $data = $this->realService->loadUserData($userId);
        $this->cache[$userId] = $data;
        return $data;
    }
}

// 4. استفاده در کد کلاینت
echo "--- Trying with 'viewer' role ---\n";
$proxy = new UserDataProxy('viewer');
$data = $proxy->loadUserData(123);
print_r($data);

echo "\n--- Trying with 'admin' role (first time) ---\n";
$proxyAdmin = new UserDataProxy('admin');
$data = $proxyAdmin->loadUserData(123);
print_r($data);

echo "\n--- Trying with 'admin' role (second time - cached) ---\n";
$data = $proxyAdmin->loadUserData(123);
print_r($data);
