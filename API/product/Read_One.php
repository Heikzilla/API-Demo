<?php
/**
 * Created by PhpStorm.
 * User: Heikel
 * Date: 14.11.2018
 * Time: 09:49
 */
//required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Header: access");
header("Access-Control-Allow-Methods: GET");
header("Accesss-Control-Allow-Credentials: true");
header('Content-Type: application/json');

//includes database and objects
include_once '../config/Database.php';
include_once '../objects/Product.php';

//Get Database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

//set ID property of record to read
$product->id = isset($_GET['id']) ? $_GET['id'] : die();

//read the details of product to be edited
$product->readOne();

if ($product->name != null){
    //create Product
    $product_arr = array(
        "id" => $product->id,
        "name" => $product->name,
        "description" => $product->description,
        "price" => $product->price,
        "category_id" => $product->category_id,
        "category_name" => $product->category_name
    );

    // set response code: 200 OK
    http_response_code(200);

    //make it json format
    echo json_encode($product_arr);
}else{
    //set response code: 400 Not Found
    http_response_code(404);

    echo json_encode(array("message" => "Produkt existiert nicht."))
}

?>