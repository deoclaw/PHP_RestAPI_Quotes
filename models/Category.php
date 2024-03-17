<?php

class Category {
    //class for our categorys

    //db stuff
    private $conn;
    private $table = 'categories';

    /*
        a) All requests should provide a JSON data response.
        b) All requests for quotes should return the id, quote, category (name), and category (name)
        c) All requests for categorys should return the id and category fields.
        d) All requests for categories should return the id and category fields.
        e) Appropriate not found and missing parameter messages as indicated below

        I can GET, POST (make), PUT (update), and DELETE an category
    */

    // category properties: id and category
    public $id;
    public $category;

    //constructor with DB -> runs when we instantiate
    //tells our cnx to point to the db we pass in
    public function __construct($db) {
        $this->conn = $db;
    }

    //GET categorys
    public function read() {
        //create our query
        //simple -- just get our cats
        $query = 'SELECT * FROM '.$this->table;

        //PREPARE STATMENT
        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }

    //GET ONE INDIVIDUAL cat
    public function read_single() {
        $query = 'SELECT * FROM '.$this->table.' WHERE id = :id';

        //PREPARE STATMENT
        $stmt = $this->conn->prepare($query);
        
        //bind id
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();

        //get returned array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->id = $row['id'];
        $this->category = $row['category'];
    }

    //CREATE an category
    public function create() {
        $query = 'INSERT INTO '.$this->table.' (category) VALUES (:category)';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->category = htmlspecialchars(strip_tags($this->category));

        //bind
        $stmt->bindParam(':category', $this->category);

        //execute our query
        if($stmt->execute()){
            return true;
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;


    }

    //UPDATE an category
    public function update() {
        $query = 'UPDATE '.$this->table.' SET category=:category WHERE id=:id';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->category = htmlspecialchars(strip_tags($this->category));

        //bind
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':category', $this->category);

        //execute our query
        if($stmt->execute()){
            return true;
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;

    }

    //DELETE an category
    public function delete() {
        $query = 'DELETE FROM '. $this->table.' WHERE id=:id';

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