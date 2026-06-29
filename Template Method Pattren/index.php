<?php

abstract class Book
{
    protected $title;
    protected $content;

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }
}


class PaperBook extends Book {
    public function printBook(): string
    {
        return "The Book '{$this->title}' was printed";
    }

}

class EBook extends Book {
    public function generatePDF()
    {
        return "A PDF was generated for the ebook '{$this->title}'";
    }

}

$paperBook = new PaperBook();

$paperBook->setTitle("this is book");

$paperBook->printBook();