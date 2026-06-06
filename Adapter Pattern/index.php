<?php


class Facebook {
    public function getUserToken($userData)
    {
        // return token
    }

    public function postUpdate($token , $message)
    {
        //
    }
}


class Twitter
{
    public function checkUserToken($userData)
    {
        // return token
        return '';
    }
    public function setStatusUpdate($token, $message)
    {
        return '';
    }
}



interface iStatusUpdate {
    public function getUserToken($userData);
    public function postUpdate($token , $message);
}

class TwitterAdapter implements iStatusUpdate {
    protected $twitter;

    /**
     * TwitterAdapter constructor.
     * @param $twitter
     */
    public function __construct(Twitter $twitter)
    {
        $this->twitter = $twitter;
    }


    public function getUserToken($userData)
    {
        return $this->twitter->checkUserToken($userData);
    }

    public function postUpdate($token , $messagee)
    {
        return $this->twitter->setStatusUpdate($token , $messagee);
    }
}

$statusUpdate = new SomeOtherServiceAdapteer(new SomeOtherService());
$token = $statusUpdate->getUserToken([ 'email' => 'hesam@gmail.com' , 'password' => '123456']);
$statusUpdate->postUpdate($token , 'some message');

class SomeOtherServiceAdapteer implements iStatusUpdate {

    protected $otherService;

    /**
     * SomeOtherServiceAdapteer constructor.
     * @param $otherService
     */
    public function __construct(SomeOtherService $otherService)
    {
        $this->otherService = $otherService;
    }


    public function getUserToken($userData)
    {
        return $this->otherService->authenticate($userData);
    }

    public function postUpdate($token, $message)
    {
        // TODO: Implement postUpdate() method.
    }
}

