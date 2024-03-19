<?php

class Author {
    //class for our authors

    //db stuff
    private $conn;
    private $table = 'author';

    /*
        a) All requests should provide a JSON data response.
        b) All requests for quotes should return the id, quote, author (name), and category (name)
        c) All requests for authors should return the id and author fields.
        d) All requests for categories should return the id and category fields.
        e) Appropriate not found and missing parameter messages as indicated below

        I can GET, POST (make), PUT (update), and DELETE an author
    */

    // author properties: id and author
    public $id;
    public $author;

    //constructor with DB -> runs when we instantiate
    //tells our cnx to point to the db we pass in
    public function __construct($db) {
        $this->conn = $db;
    }

    //GET authors
    public function read() {
        //create our query
        //simple -- just get our authors
        $query = 'SELECT * FROM author';

        //PREPARE STATMENT
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //GET ONE INDIVIDUAL author
    public function read_single() {
        $query = 'SELECT * FROM author WHERE id = :id';

        //PREPARE STATMENT
        $stmt = $this->conn->prepare($query);
        
        //bind id
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        //get returned array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($row);
        if (count($row)>0){
        $this->id = $row['id'];
        $this->author = $row['author'];
        }
    }

    //CREATE an author
    public function create() {
        $query = 'INSERT INTO author(author) VALUES (:author)';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->author = htmlspecialchars(strip_tags($this->author));

        //bind
        $stmt->bindParam(':author', $this->author);

        //execute our query
        if($stmt->execute()){
            $query = 'SELECT * FROM author WHERE author = :author';

            //PREPARE STATMENT
            $stmt = $this->conn->prepare($query);
        
            //bind id
            $stmt->bindParam(':author', $this->author);
            $stmt->execute();
            //get returned array
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->author = $row['author'];
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;


    }

    //UPDATE an author
    public function update() {
        $query = 'UPDATE author SET author=:author WHERE id=:id';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->author = htmlspecialchars(strip_tags($this->author));

        //bind
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':author', $this->author);

        //execute our query
        if($stmt->execute()){
            return true;
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;

    }

    //DELETE an author
    public function delete() {
        $query = 'DELETE FROM author WHERE id=:id';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind
        $stmt->bindParam(':id', $this->id);

        //execute our query
        if($stmt->execute()){
            return true;
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;
    }


}