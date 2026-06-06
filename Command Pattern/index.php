<?php
//
//
//abstract class CarWashCommand {
//    protected $car;
//
//    public function __construct(CarInterface $car)
//    {
//        $this->car = $car;
//    }
//
//    abstract public function execute();
//}
//
//class CarSimpleWashCommand extends CarWashCommand {
//
//    public function execute()
//    {
//        return '';
//    }
//}
//class CarDryCommand extends CarWashCommand {
//
//    public function execute()
//    {
//        // TODO: Implement execute() method.
//    }
//}
//class CarWaxCommand extends CarWashCommand {
//
//    public function execute()
//    {
//        // TODO: Implement execute() method.
//    }
//}
//interface CarInterface {
//
//}
//
//class PraidCar implements CarInterface {
//
//}
//class CarWash {
//    protected $CustomerList;
//
//    public function newCustomer($TaskList)
//    {
//        $this->CustomerList[] = $TaskList;
//    }
//
//    public function wash()
//    {
//        foreach ( $this->CustomerList as $customer ) {
//            foreach ($customer as $command) {
//                $command->execute();
//            }
//        }
//    }
//}
//
//$car = new PraidCar();
//$carWash = new CarWash();
//
//$carWash->newCustomer(
//    new CarSimpleWashCommand($car),
//    new CarDryCommand($car)
//);
//
//$carWash->newCustomer(
//    new CarSimpleWashCommand($car),
//    new CarDryCommand($car),
//    new CarWaxCommand($car)
//);
//
//$carWash->wash();
//



class Message {
    protected $queue = [];

    public function addMessage(IMessageSender $sender)
    {
        $this->queue[] = $sender;
    }

    public function executeQueue()
    {
        foreach ($this->queue as $sender) {
            $statusSendingMessage = false;
            while (! $statusSendingMessage ) {
                $statusSendingMessage = $sender->sendMessage();
            }
        }
    }
}

interface IMessageSender {
    public function sendMessage();
}

class SendEmail implements IMessageSender {
    protected $title;
    protected $message;
    protected $emailAdress;

    /**
     * SendEmail constructor.
     * @param $title
     * @param $message
     * @param $emailAdress
     */
    public function __construct($title, $message, $emailAdress)
    {
        $this->title = $title;
        $this->message = $message;
        $this->emailAdress = $emailAdress;
    }

    public function sendMessage()
    {
//      $status = Mail::send();
//        return $status;
    }
}
class SendSms implements IMessageSender {
    protected $title;
    protected $message;
    protected $phonNumber;

    /**
     * SendEmail constructor.
     * @param $title
     * @param $message
     * @param $phonNumber
     */
    public function __construct($title, $message, $phonNumber)
    {
        $this->title = $title;
        $this->message = $message;
        $this->phonNumber = $phonNumber;
    }

    public function sendMessage()
    {
//      $status = api send sms
//        return $status;
    }
}


$messageQueue = new Message();
$messageQueue->addMessage(new SendEmail('hesam' , 'this is hesam mousavi' , 'HesamMousavi@gmail.com'));
$messageQueue->addMessage(new SendSms('hesam' , 'this is hesam mousavi' , 'HesamMousavi@gmail.com'));

$messageQueue->executeQueue();