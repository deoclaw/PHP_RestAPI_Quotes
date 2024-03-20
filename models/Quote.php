<?php

class Quote{
    //db stuff
    private $conn;
    private $table = 'quotes';

    /*
        a) All requests should provide a JSON data response.
        b) All requests for quotes should return the id, quote, author (name), and category (name)
        c) All requests for authors should return the id and author fields.
        d) All requests for categories should return the id and category fields.
        e) Appropriate not found and missing parameter messages as indicated below

        I can GET, POST (make), PUT (update), and DELETE an author
    */

    // quote properties: id, quote, author (name), and category (name)
    public $id;
    public $quote;
    public $author_id;
    public $category_id;
    public $author_name; //use joins to get
    public $category_name; //use joins to get

    //constructor with DB -> runs when we instantiate
    //tell our connection to point to the db we pass in
    public function __construct($db) {
        $this->conn = $db;
    }

    //GET QUOTES
    public function read(){
        $query = 'SELECT
            a.author as author_name,
            c.category as category_name,
            q.id,
            q.quote,
            q.author_id,
            q.category_id
        FROM '.$this->table.' q
        INNER JOIN categories c on q.category_id = c.id
        INNER JOIN author a on q.author_id = a.id';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;

    }

    //get multiple
    public function read_by_author(){
        $query = 'SELECT
            a.author as author_name,
            c.category as category_name,
            q.id,
            q.quote,
            q.author_id,
            q.category_id
        FROM '.$this->table.' q
        INNER JOIN categories c on q.category_id = c.id
        INNER JOIN author a on q.author_id = a.id
        WHERE
            q.author_id = :author_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':author_id', $this->author_id);
        //$stmt->bindParam(':category_id', $this->category_id);

        $stmt->execute();
        return $stmt;
    }
    public function read_by_category(){
        $query = 'SELECT
            a.author as author_name,
            c.category as category_name,
            q.id,
            q.quote,
            q.author_id,
            q.category_id
        FROM '.$this->table.' q
        INNER JOIN categories c on q.category_id = c.id
        INNER JOIN author a on q.author_id = a.id
        WHERE
            q.category_id = :category_id';

        $stmt = $this->conn->prepare($query);

        //$stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        $stmt->execute();
        return $stmt;
    }

    public function read_by_both(){
        $query = 'SELECT
            a.author as author_name,
            c.category as category_name,
            q.id,
            q.quote,
            q.author_id,
            q.category_id
        FROM '.$this->table.' q
        INNER JOIN categories c on q.category_id = c.id
        INNER JOIN author a on q.author_id = a.id
        WHERE
            q.author_id = :author_id 
        AND 
            q.category_id = :category_id';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        $stmt->execute();
        
        return $stmt;
        
    }

    //get single
    public function read_single(){
        $query = 'SELECT
            a.author as author_name,
            c.category as category_name,
            q.id,
            q.quote,
            q.author_id,
            q.category_id
        FROM '.$this->table.' q
        INNER JOIN categories c on q.category_id = c.id
        INNER JOIN author a on q.author_id = a.id
        WHERE
            q.id = :id';

        //PREPARE STATMENT
        $stmt = $this->conn->prepare($query);
        
        //bind ID (the ?)
        $stmt->bindParam(':id', $this->id);
        //the 1 finds the first ?

        //execute query
        $stmt->execute();

        $num = $stmt->rowCount();
        if($num === 0){
            $this->id = NULL;
            $this->quote = NULL;
            $this->author_id = NULL;
            $this->author_name= NULL;
            $this->category_id = NULL;
            $this->category_name = NULL;
        } else{

        //grab the array that returns
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //set properties to whatever's returned
        $this->id = $row['id'];
        $this->quote = $row['quote'];
        $this->author_id = $row['author_id'];
        $this->author_name= $row['author_name'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
        }
    }

    //create quote
    public function create() {
        $query = 'INSERT INTO '.$this->table.' (quote, author_id, category_id) VALUES (:quote, :author_id, :category_id)';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //bind
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        //execute our query
        if($stmt->execute()){
            return true;
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //update quote
    public function update() {
        $query = 'UPDATE '.$this->table.' SET quote=:quote, author_id=:author_id, category_id=:category_id WHERE id=:id';

        $stmt = $this->conn->prepare($query);

        //clean and secure data bc users suck
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));

        //bind
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);

        //execute our query
        if($stmt->execute()){
            return true;
        }

        //if error happens, print it
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    //delete quote
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