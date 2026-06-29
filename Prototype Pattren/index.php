<?php


interface Prototype {
    public function __clone();
}

abstract class Book {
    protected $title;
    protected $topic;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTopic()
    {
        return $this->topic;
    }

    /**
     * @param mixed $topic
     */
    public function setTopic($topic)
    {
        $this->topic = $topic;
    }


}

class PHPBook extends Book implements Prototype {
    public function __construct()
    {
        $this->title = "PHPBook";
    }

    public function __clone()
    {
        // TODO: Implement __clone() method.
    }
}


$phpBook = new PHPBook();
$book1 = clone $phpBook;

$book1->setTopic("a new topic");

var_dump($book1);
