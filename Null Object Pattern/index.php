<?php


interface Request {
    public function execute();
}

class ARequest implements Request {
    public function execute()
    {
        // do something
    }
}
class BRequest implements Request {
    public function execute()
    {
        // do something
    }
}
class CRequest implements Request {
    public function execute()
    {
        // do something
    }
}

class NullRequest implements Request {

    public function execute()
    {
        // log error
    }
}

class Client {
    public function getRequest($command)
    {
        if($command == 'A')
            return new ARequest();

        if($command == 'B')
            return new BRequest();

        if($command == 'C')
            return new CRequest();

        return new NullRequest();
    }
}


$client = new Client();
$request = $client->getRequest('D');
$request->execute();

class X {
    public function doSomething(Request $request) {
        $request->execute();
    }
}
