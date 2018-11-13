<?php
/**
 * Created by PhpStorm.
 * User: heikel
 * Date: 12.11.18
 * Time: 16:33
 */

class Product
{
    //database connection and Table
    private $conn;
    private $table_name = "products";

    //object properties
    public $id;
    public $name;
    public $description;
    public $price;
    public $category_id;
    public $category_name;
    public $created;

    //constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

    //read products
    function read(){

        //select all query
        $query = "SELECT c.name as category_name, p.id, p.name, p.price, p.category_id, p.created
            FROM
                " . $this->table_name . " p 
                LEFT JOIN
                    categories c
                        ON p.category_id = c.id
                ORDER BY
                    p.created DESC";

        //prepare query statement
        $stmt = $this->conn->prepare($query);

        //execute statement
        $stmt->execute();

        return $stmt;
    }

}