<?php

// ============ پیاده‌سازی (Implementation) ============
// اینترفیس روش ارسال
interface MessageSender {
    public function send($to, $message);
}

// پیاده‌سازی‌های مختلف روش ارسال
class EmailSender implements MessageSender {
    public function send($to, $message) {
        return "Sending EMAIL to [$to]: $message";
    }
}

class SmsSender implements MessageSender {
    public function send($to, $message) {
        return "Sending SMS to [$to]: $message";
    }
}

class TelegramSender implements MessageSender {
    public function send($to, $message) {
        return "Sending TELEGRAM to [$to]: $message";
    }
}

// ============ انتزاع (Abstraction) ============
// کلاس پایه پیام‌ها
abstract class Message {
    protected $sender;
    
    public function __construct(MessageSender $sender) {
        $this->sender = $sender;
    }
    
    abstract public function sendMessage($recipient, $content);
}

// انواع مختلف پیام‌ها
class SimpleMessage extends Message {
    public function sendMessage($recipient, $content) {
        return $this->sender->send($recipient, $content);
    }
}

class UrgentMessage extends Message {
    public function sendMessage($recipient, $content) {
        return $this->sender->send($recipient, "[URGENT] " . strtoupper($content));
    }
}

class InstantMessage extends Message {
    public function sendMessage($recipient, $content) {
        $timestamp = date('Y-m-d H:i:s');
        return $this->sender->send($recipient, "[$timestamp] $content");
    }
}

// ============ استفاده در کد کلاینت ============

echo "=== سناریو 1: پیام ساده از طریق ایمیل ===\n";
$simpleEmail = new SimpleMessage(new EmailSender());
echo $simpleEmail->sendMessage("user@example.com", "سلام، چطوری؟") . "\n\n";

echo "=== سناریو 2: پیام فوری از طریق SMS ===\n";
$instantSms = new InstantMessage(new SmsSender());
echo $instantSms->sendMessage("09121234567", "جلسه تیم 10 دقیقه دیگه") . "\n\n";

echo "=== سناریو 3: پیام مهم از طریق تلگرام ===\n";
$urgentTelegram = new UrgentMessage(new TelegramSender());
echo $urgentTelegram->sendMessage("@username", "سرور دچار مشکل شده است") . "\n\n";

echo "=== سناریو 4: ترکیب جدید - پیام مهم از طریق SMS ===\n";
$urgentSms = new UrgentMessage(new SmsSender());
echo $urgentSms->sendMessage("09121234567", "فردا تعطیل است") . "\n\n";

echo "=== سناریو 5: ترکیب جدید - پیام ساده از طریق تلگرام ===\n";
$simpleTelegram = new SimpleMessage(new TelegramSender());
echo $simpleTelegram->sendMessage("@user", "فایل مورد نظر آپلود شد") . "\n";