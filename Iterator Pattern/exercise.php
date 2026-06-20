<?php

class User
{
    public function __construct(
        private readonly string $name,
        private readonly int    $age
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function getUserInfo(): string
    {
        return $this->getName() . ' (' . $this->getAge() . ')';
    }
}

class UserList implements Countable, Iterator
{
    /**
     * @var User[]
     */
    private array $users = [];
    private int $currentIndex = 0;

    public function addUser(User $user)
    {
        $this->users[] = $user;
    }

    public function removeUser(User $userToRemove)
    {
        foreach ($this->users as $key => $user) {
            if ($user->getUserInfo() === $userToRemove->getUserInfo()) {
                unset($this->users[$key]);
            }
        }

        $this->users = array_values($this->users);
    }

    public function count(): int
    {
        return count($this->users);
    }

    public function current(): User
    {
        return $this->users[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next()
    {
        $this->currentIndex++;
    }

    public function rewind()
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->users[$this->currentIndex]);
    }
}


// create some users
$user1 = new User('Saleh', 31);
$user2 = new User('Ahmad', 28);
$user3 = new User('Mina', 31);

// create a user list and add the users to it
$userList = new UserList();
$userList->addUser($user1);
$userList->addUser($user2);
$userList->addUser($user3);

// iterate over the user list and output each user's name
foreach ($userList as $user) {
    echo $user->getName() . PHP_EOL;
}

// remove a user from the list
$userList->removeUser($user2);

// iterate over the user list again, this time only outputting the age
foreach ($userList as $user) {
    echo $user->getAge() . PHP_EOL;
}

// output the total number of users in the list
echo 'Total number of users: ' . count($userList) . PHP_EOL;


