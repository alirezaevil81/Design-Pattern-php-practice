<?php

interface NotificationInterface {

    public function send(string $message): string;
}

class Telegram implements NotificationInterface {
    public function send(string $message): string
    {
        return "sending telegram message" . $message;
    }
}

class SMS implements NotificationInterface {
    public function send(string $message): string
    {
        return "sending SMS message" . $message;
    }
}

class Email implements NotificationInterface {
    public function send(string $message): string
    {
        return "sending Email" . $message;
    }
}

class NotificationService {

    public function __construct
    (
        protected NotificationInterface $sender
    )
    {

    }

    public function send($message) : string {
        return $this->sender->send($message);
    }
}



$notify = new NotificationService(new Telegram());
$notify->send('hi');