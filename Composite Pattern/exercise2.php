<?php

// Component interface
interface Product
{
    public function getName(): string;

    public function getPrice(): float;
}


// Composite class
class ProductCatalog implements Product
{
    private array $products = [];

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
    }

    public function getName(): string
    {
        return "Product Catalog";
    }

    public function getPrice(): float
    {
        $totalPrice = 0;

        foreach ($this->products as $product) {
            $totalPrice += $product->getPrice();
        }

        return $totalPrice;
    }
}

// Leaf classes
class Book implements Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class Gadget implements Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class Movie implements Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}

class Song implements Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}  



// Usage example
$book = new Book("The Hitchhiker's Guide to the Galaxy", 10.99);
$gadget = new Gadget("Wireless Headphones", 79.99);
$movie = new Movie("Inception", 7.99);
$song = new Song("Bohemian Rhapsody", 0.99);

$catalog = new ProductCatalog();
$catalog->addProduct($book);
$catalog->addProduct($gadget);
$catalog->addProduct($movie);
$catalog->addProduct($song);

echo $catalog->getName() . "\n";
echo "Total price: $" . $catalog->getPrice();