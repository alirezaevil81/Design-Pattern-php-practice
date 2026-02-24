<?php

class UserService implements SplSubject 
{
    private $observers = [];
    private $users = [];

    public function attach(SplObserver $observer) : void
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer) : void
    {
        $index = array_search($observer, $this->observers);
        if ($index !== false) {
            unset($this->observers[$index]);
        }
    }

    public function notify() : void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function addUser($user) 
    {
        $this->users[] = $user;
        $this->notify();
    }

    public function getUsers() 
    {
        return $this->users;
    }
}

class UserObserver implements SplObserver 
{
    public function update(SplSubject $subject) : void
    {
        echo "New user added \n";
    }
}

$userService = new UserService();

$userService->attach(new UserObserver());

$userService->addUser("John Doe"); 

