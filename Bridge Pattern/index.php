<?php

//abstract class Shape {
//    protected $width;
//    protected $height;
//    protected $color;
//
//    public function __construct(Color $color)
//    {
//        $this->color = $color;
//    }
//
//    abstract public function draw();
//
//    public function changeColor(Color $color)
//    {
//        $this->color = $color;
//    }
//}
//
//class Circle extends Shape
//{
//    public function draw()
//    {
//        return $this->color;
//    }
//}
//
//class Square extends Shape
//{
//
//    public function draw()
//    {
//        // TODO: Implement draw() method.
//    }
//}
//
//abstract class Color {
//    protected $color;
//    abstract public function setColor();
//}
//
//class Red extends Color
//{
//
//    public function setColor()
//    {
//        // TODO: Implement setColor() method.
//    }
//}
//
//class Blue extends Color {
//
//    public function setColor()
//    {
//        // TODO: Implement setColor() method.
//    }
//}
//
//$red = new Red();
//$blue = new Blue();
//
//$circleOne = new Circle($red);
//echo $circleOne->draw();
//
//$circleOne->changeColor($blue);
//echo $circleOne->draw();




class RemoteControl
{
    protected $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function togglePower()
    {
        if($this->device->isEnabled()) {
            $this->device->disable();
        } else {
            $this->device->enable();
        }
    }

    public function volumeDown()
    {
        $this->device->setVolume($this->device->getVolume() - 10);
    }

    public function volumeUp()
    {
        $this->device->setVolume($this->device->getVolume() + 10);
    }

    public function channelUp()
    {
        $this->device->setChannel($this->device->getChannel() + 1);
    }

    public function channelDown()
    {
        $this->device->setChannel($this->device->getChannel() - 1);
    }
}

class AdvancedRemote extends RemoteControl {
    public function mute()
    {
        $this->device->setVolume(0);
    }
}

interface Device {
    public function isEnabled();
    public function enable();
    public function disable();
    public function getVolume();
    public function setVolume($percent);
    public function getChannel();
    public function setChannel($channel);
}

class Tv implements Device {

    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
    }

    public function enable()
    {
        // TODO: Implement enable() method.
    }

    public function disable()
    {
        // TODO: Implement disable() method.
    }

    public function getVolume()
    {
        // TODO: Implement getVolume() method.
    }

    public function setVolume($percent)
    {
        // TODO: Implement setVolume() method.
    }

    public function getChannel()
    {
        // TODO: Implement getChannel() method.
    }

    public function setChannel($channel)
    {
        // TODO: Implement setChannel() method.
    }
}


class Radio implements Device {

    public function isEnabled()
    {
        // TODO: Implement isEnabled() method.
    }

    public function enable()
    {
        // TODO: Implement enable() method.
    }

    public function disable()
    {
        // TODO: Implement disable() method.
    }

    public function getVolume()
    {
        // TODO: Implement getVolume() method.
    }

    public function setVolume($percent)
    {
        // TODO: Implement setVolume() method.
    }

    public function getChannel()
    {
        // TODO: Implement getChannel() method.
    }

    public function setChannel($channel)
    {
        // TODO: Implement setChannel() method.
    }
}



$radio = new Radio();
$remote = new RemoteControl($radio);

$tv = new Tv();
$remote = new AdvancedRemote($tv);