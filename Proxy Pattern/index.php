<?php

abstract class ReadFileAbstract
{
    protected $fileName;
    protected $contents;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getContents()
    {
        return $this->contents;
    }
}

class ReadFile extends ReadFileAbstract {

    const DOCUMENTS_PATH = __DIR__;

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
        $this->contents = file_get_contents(self::DOCUMENTS_PATH . "/" . $this->getFileName());
    }
}

class ReadFileProxy extends ReadFileAbstract
{
    private $file;

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
    }

    public function lazyLoad()
    {
        if($this->file === null) {
            $this->file = new ReadFile($this->getFileName());
        }
        return $this->file;
    }
}

$fileOne = new ReadFileProxy('fileOne.txt');
$fileTwo = new ReadFileProxy('fileTwo.txt');

$fileOne = $fileOne->lazyLoad();

echo $fileOne->getContents();
