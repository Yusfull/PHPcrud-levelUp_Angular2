<?php

class Product
{
    // database connection and table name
    private $conn;
    private $table_name = "products";
    // object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $created;
    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }
    // create product
    function create()
    {
        // query to insert record
        $query = "INSERT INTO 
                " . $this->table_name . "
            SET 
                name=:name, price=:price, description=:description, created=:created";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // posted values
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->description = htmlspecialchars(strip_tags($this->description));
        // bind values
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":created", $this->created);
        // execute query
        if ($stmt->execute()) {
            return true;
        } else {
            echo "<pre>";
            print_r($stmt->errorInfo());
            echo "</pre>";
            return false;
        }
    }

    // read products
    function readAll(){
    
        // select all query
        $query = "SELECT 
                    id, name, description, price, created 
                FROM 
                    " . $this->table_name . "
                ORDER BY 
                    id DESC";
    
        // prepare query statement
        $stmt = $this->conn->prepare( $query );
        
        // execute query
        $stmt->execute();
        
        return $stmt;
    }
}
?>