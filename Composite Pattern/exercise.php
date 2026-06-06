<?php

interface FileSystemNode {
    public function getSize();
    public function getName();
}

// برگ (Leaf) - فایل
class File implements FileSystemNode {
    private $name;
    private $size;
    
    public function __construct($name, $size) {
        $this->name = $name;
        $this->size = $size;
    }
    
    public function getSize() {
        return $this->size;
    }
    
    public function getName() {
        return $this->name;
    }
}

// مرکب (Composite) - فولدر
class Folder implements FileSystemNode {
    private $name;
    private $children = [];
    
    public function __construct($name) {
        $this->name = $name;
    }
    
    public function add(FileSystemNode $node) {
        $this->children[] = $node;
    }
    
    public function getSize() {
        $total = 0;
        foreach ($this->children as $child) {
            $total += $child->getSize();
        }
        return $total;
    }
    
    public function getName() {
        return $this->name;
    }
}

// استفاده
$folder = new Folder("Documents");
$folder->add(new File("resume.pdf", 1024));
$folder->add(new File("photo.jpg", 2048));

$subFolder = new Folder("Projects");
$subFolder->add(new File("code.php", 512));
$subFolder->add(new File("readme.txt", 128));

$folder->add($subFolder);

echo "Size of '{$folder->getName()}': {$folder->getSize()} bytes\n";
// خروجی: Size of 'Documents': 3712 bytes