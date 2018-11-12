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
    public $screated;

    //constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
    }

}