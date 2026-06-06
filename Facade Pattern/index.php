<?php

class Validate {
    public function isValid($data) {
        return true;
    }
}

class User {
    public function create($data) {
        return true;
    }
}

class Mail {

    public function to($email_adress) {

        return $this;
    }

    public function subject($subject)
    {
        return $this;
    }

    public function send() {
        return true;
    }
}

class Auth {
    public function login($email , $password)
    {
        return true;
    }
}


class AuthFacade {
    private $validate;
    private $user;
    private $auth;
    private $email;

    /**
     * SignUpFacade constructor.
     * @param $validate
     * @param $user
     * @param $auth
     * @param $email
     */
    public function __construct()
    {
        $this->validate = new Validate();
        $this->user = new User();
        $this->auth = new Auth();;
        $this->email = new Mail();
    }

    public function singUpUser($name , $email , $password) {
        $data = ['email' => $email , 'name' => $name , 'password' => $password];
        if($this->validate->isValid($data)) {
            $this->user->create($data);
            $this->auth->login($data['email'] , $data['password']);
            $this->email->to($data['email']);
        }

    }

    public function singInUser($email , $password)
    {
        return $this->auth->login($email , $password);
    }


}


$authFacade = new AuthFacade();
$authFacade->singUpUser('hesam' , 'hesam@gmail.com' , '123456');

$authFacade->singInUser('hesam@gmail.com' , '123456');

