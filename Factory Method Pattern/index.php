<?php

interface Transport {
    public function deliver($place);
}

class Truck implements Transport {

    public function deliver($place)
    {
        return $place;
    }

}

class Ship implements Transport {

    public function deliver($place)
    {
        return $place;
    }

}


abstract class Logistic {
    abstract public function createTransport();

    public function planDelivery($place)
    {
        $transport = $this->createTransport();
        $transport->deliver($place);
        return $transport;
    }
}

class RoadLogistic extends Logistic {

    public function createTransport()
    {
        return new Truck();
    }
}

class SeaLogistic extends Logistic {

    public function createTransport()
    {
        return new Ship();
    }
}

$road = new RoadLogistic();
$sea = new SeaLogistic();

// transport 1
$truck1 = $road->planDelivery('Tehran');

// transport 2
$truck2 = $road->planDelivery('Ardebil');

// transport 3
$truck3 = $road->createTransport();
$truck3->deliver('Manzandaran');

// transport 4
$ship4 = $sea->planDelivery('America');

// transport 5
$ship5 = $sea->planDelivery('China');
