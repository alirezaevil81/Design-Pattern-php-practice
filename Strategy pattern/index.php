<?php

interface PaymentGatewayStrategy
{
    public function setInfo(array $data): void;

    public function pay(int $amount): string;
}

class ZarinpalGateway implements PaymentGatewayStrategy
{
    private array $info = [];

    public function setInfo(array $data): void
    {
        $this->info = $data;
    }

    public function pay(int $amount): string
    {
        // simulate zarinpal payment
        return "Zarinpal payment of {$amount} processed.";
    }
}

class MellatGateway implements PaymentGatewayStrategy
{
    private array $info = [];

    public function setInfo(array $data): void
    {
        $this->info = $data;
    }

    public function pay(int $amount): string
    {
        // simulate mellat payment
        return "Mellat payment of {$amount} processed.";
    }
}

class PaymentProcessor
{
    public function __construct(
        private PaymentGatewayStrategy $gateway
    ) {}

    public function process(array $info, int $amount): string
    {
        $this->gateway->setInfo($info);

        return $this->gateway->pay($amount);
    }
}

$gateway = new ZarinpalGateway();
// $gateway = new MellatGateway();

$processor = new PaymentProcessor($gateway);

echo $processor->process(
    ['merchant_id' => '123ABC'],
    500000
);