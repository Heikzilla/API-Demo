<?php
/**
 * Created by PhpStorm.
 * User: Heikel
 * Date: 20.11.2018
 * Time: 21:47
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object file
include_once '../config/Database.php';
include_once '../objects/Product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$product = new Product($db);

// get product id
$data = json_decode(file_get_contents("php://input"));

// set product id to be deleted
$product->id = $data->id;

// delete the product
if ($product->delete()){

    // set response code - Jupp 200. Runs
    http_response_code(200);

    // tell the user
    echo json_encode(array("message"=> "Product was deleted"));
} else {

// if unable to delete
http_response_code(503);

// tell the user
    echo json_encode(array("message"=>"Unable to delete product"));

}