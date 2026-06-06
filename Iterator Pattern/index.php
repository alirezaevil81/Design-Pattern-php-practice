<?php


class Movie
{
    private $title;
    private $releaseYear;

    /**
     * Movie constructor.
     * @param $title
     * @param $releaseYear
     */
    public function __construct($title, $releaseYear)
    {
        $this->title = $title;
        $this->releaseYear = $releaseYear;
    }

    public function showInfo()
    {
        echo "<strong>Movie:</strong> {$this->title} ({$this->releaseYear}) <br>";
    }
}

interface CollectionIterator {
    public function createNormalIterator();
    public function depthFirstIterator();
}

class MovieList implements CollectionIterator, IteratorAggregate
{
    private $movies = [];

    public function addMovie(Movie $movie)
    {
        $this->movies[] = $movie;
    }

    public function getMovies()
    {
        return $this->movies;
    }

    public function createNormalIterator()
    {
       return new NormalMoviesIterator($this);
    }

//    public function depthFirstIterator()
//    {
//       return new DepthFirstMoviesIterator($this);
//    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new NormalMoviesIterator($this);
    }

    public function depthFirstIterator()
    {
        // TODO: Implement depthFirstIterator() method.
    }
}

//interface MoviesIterator {
//    public function hasNext();
//    public function getNext();
//}
//
//class NormalMoviesIterator implements MoviesIterator
//{
//    private $moviePosition = 0;
//    private $movieList;
//
//    public function __construct(MovieList $movieList)
//    {
//        $this->movieList = $movieList;
//    }
//
//    public function hasNext()
//    {
//        return $this->moviePosition < count($this->movieList->getMovies());
//    }
//
//    public function getNext()
//    {
//        $movie = $this->movieList->getMovies()[$this->moviePosition];
//        $this->moviePosition += 1;
//        return $movie;
//    }
//}

class NormalMoviesIterator implements Iterator {
    private $moviePosition = 0;
    private $movieList;

    public function __construct(MovieList $movieList)
    {
        $this->movieList = $movieList;
    }

    /**
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        return $this->movieList->getMovies()[$this->moviePosition];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->moviePosition += 1;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->moviePosition;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return isset($this->movieList->getMovies()[$this->moviePosition]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->moviePosition = 0;
    }
}
//class DepthFirstMoviesIterator implements MoviesIterator {
//
//    public function hasNext()
//    {
//        // TODO: Implement hasNext() method.
//    }
//
//    public function getNext()
//    {
//        // TODO: Implement getNext() method.
//    }
//}

$movieList = new MovieList();
$movieList->addMovie(new Movie('Inception' , 2010));
$movieList->addMovie(new Movie('Avatar' , 2009));
$movieList->addMovie(new Movie('Man Of Steel' , 2013));
$movieList->addMovie(new Movie('Up' , 2009));


$iterator = $movieList->getIterator();
foreach ($iterator as $key => $value) {
    echo "$value";
    $value->showInfo();
}

