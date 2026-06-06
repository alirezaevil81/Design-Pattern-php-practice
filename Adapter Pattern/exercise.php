<?php


// Target Interface
interface PaymentGateway
{
    public function pay(float $amount): bool;
}


// Adaptee 1: Paypal
class Paypal
{
    public function processPayment(float $amount, string $currency): bool
    {
        echo "Processing USD {$amount} payment via PayPal.<br>";
        // ... منطق پرداخت پی‌پال ...
        return true;
    }
}

// Adaptee 2: Stripe
class Stripe
{
    public function charge(float $amount, string $apiKey): bool
    {
        echo "Charging {$amount} via Stripe with key: {$apiKey}...<br>";
        // ... منطق پرداخت استرایپ ...
        return true;
    }
}

// Adapter for Paypal
class PaypalAdapter implements PaymentGateway
{
    private Paypal $paypal;

    public function __construct(Paypal $paypal)
    {
        $this->paypal = $paypal;
    }

    public function pay(float $amount): bool
    {
        // تطبیق پارامترها: Paypal متد processPayment رو با دو پارامتر (amount, currency) صدا می‌زنه
        // ما اینجا currency رو به صورت پیش‌فرض USD در نظر می‌گیریم
        return $this->paypal->processPayment($amount, 'USD');
    }
}

// Adapter for Stripe
class StripeAdapter implements PaymentGateway
{
    private Stripe $stripe;
    private string $apiKey;

    public function __construct(Stripe $stripe, string $apiKey)
    {
        $this->stripe = $stripe;
        $this->apiKey = $apiKey;
    }

    public function pay(float $amount): bool
    {
        // تطبیق پارامترها: Stripe متد charge رو با دو پارامتر (amount, apiKey) صدا می‌زنه
        return $this->stripe->charge($amount, $this->apiKey);
    }
}


// Client code
class PaymentProcessor
{

    public function __construct()
    {
        //
    }
    public function processPayment(PaymentGateway $gateway, float $amount): void
    {
        if ($gateway->pay($amount)) {
            echo "Payment of {$amount} successful!<br>";
        } else {
            echo "Payment of {$amount} failed!<br>";
        }
    }
}

// --- استفاده از آداپتورها ---

// ساخت نمونه‌های اولیه سرویس‌های پرداخت
$paypalService = new Paypal();
$stripeService = new Stripe();

// ساخت آداپتورها
$paypalAdapter = new PaypalAdapter($paypalService);
$stripeAdapter = new StripeAdapter($stripeService, 'sk_test_YOUR_STRIPE_API_KEY'); // کلید API استرایپ

// ساخت پردازشگر پرداخت
$paymentProcessor = new PaymentProcessor();

// استفاده از پردازشگر با آداپتور پی‌پال
echo "<h2>Using PayPal Adapter:</h2>";
$paymentProcessor->processPayment($paypalAdapter, 100.50);

echo "<hr>";

// استفاده از پردازشگر با آداپتور استرایپ
echo "<h2>Using Stripe Adapter:</h2>";
$paymentProcessor->processPayment($stripeAdapter, 250.75);
