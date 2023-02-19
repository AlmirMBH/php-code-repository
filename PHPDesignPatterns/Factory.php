<?php

// FACTORY CREATES INSTANCES OF CLASSES INSTEAD OF US
class Book {
    const BR = "<br>";
    private $bookName;
    private $bookAuthor;

    public function __construct($name, $author){
        $this->bookName = $name;
        $this->bookAuthor = $author;
    }

    public function getNameAndAuthor(){
        return $this->bookName . " - " . $this->bookAuthor . self::BR;
    }
}

class BookFactory {
    public static function create($name, $author){
        return new Book($name, $author);
    }
}

$book1 = BookFactory::create("Opportunity", "Almir");
$book2 = BookFactory::create("Opportunity2", "Almir2");
echo $book1->getNameAndAuthor();
echo $book2->getNameAndAuthor();