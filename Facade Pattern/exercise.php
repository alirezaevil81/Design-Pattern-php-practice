<?php

// Classes for the complex system
class SmtpClient {
    public function connect(string $host, int $port) {
        echo "Connecting to {$host}:{$port}...\n";
        // ... actual connection logic
    }

    public function send(string $to, string $from, string $subject, string $body) {
        echo "Sending email...\n";
        echo "To: {$to}\n";
        echo "From: {$from}\n";
        echo "Subject: {$subject}\n";
        echo "Body:\n{$body}\n";
        // ... actual sending logic
    }

    public function disconnect() {
        echo "Disconnecting from SMTP server.\n";
        // ... disconnection logic
    }
}

class EmailBuilder {
    public function build(string $to, string $from, string $subject, string $body): string {
        $headers = "From: {$from}\r\n";
        $headers .= "To: {$to}\r\n";
        $headers .= "Subject: {$subject}\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

        return $headers . "\r\n" . $body;
    }
}

// The Facade class
class MailerFacade {
    private $smtpClient;
    private $emailBuilder;

    public function __construct() {
        // In a real application, these might be injected or retrieved from a container
        $this->smtpClient = new SmtpClient();
        $this->emailBuilder = new EmailBuilder();
    }

    public function sendEmail(string $to, string $from, string $subject, string $body): bool {
        // Simplified steps through the facade
        try {
            // Assume default SMTP settings for simplicity
            $this->smtpClient->connect('smtp.example.com', 587);

            $formattedEmail = $this->emailBuilder->build($to, $from, $subject, $body);

            $this->smtpClient->send($to, $from, $subject, $formattedEmail);

            $this->smtpClient->disconnect();
            echo "Email sent successfully!\n";
            return true;
        } catch (\Exception $e) {
            echo "Failed to send email: " . $e->getMessage() . "\n";
            return false;
        }
    }
}

// --- Usage ---

// Without Facade (complex way)
// echo "--- Using the system directly ---\n";
// $smtp = new SmtpClient();
// $builder = new EmailBuilder();
// $smtp->connect('smtp.example.com', 587);
// $emailContent = $builder->build('recipient@example.com', 'sender@example.com', 'Test Subject', 'This is the body of the email.');
// $smtp->send('recipient@example.com', 'sender@example.com', 'Test Subject', $emailContent);
// $smtp->disconnect();
// echo "---------------------------------\n\n";


// With Facade (simplified way)
echo "--- Using the Mailer Facade ---\n";
$mailerFacade = new MailerFacade();
$mailerFacade->sendEmail(
    'recipient@example.com',
    'sender@example.com',
    'Hello from Facade!',
    'This is a simplified email sending process using the Facade pattern.'
);
echo "-------------------------------\n";
