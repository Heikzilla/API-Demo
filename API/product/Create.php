<?php
/**
 * Created by PhpStorm.
 * User: Heikel
 * Date: 13.11.2018
 * Time: 13:50
 */
header("Access-Contol-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("AccessControl-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With");

include_once '../config/Database.php';
include_once '../objects/Product.php';

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);

$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name) &&
    !empty($data->price) &&
    !empty($data->description) &&
    !empty($data->category_id)
){
    //set Product values
    $product->name = $data->name;
    $product->price = $data->price;
    $product->description = $data->description;
    $product->category_id = $data->category_id;
    $product->created = date('Y-m-d H:i:s');

    //create Product
    if ($product->create()){

        //set response code 201
        http_response_code(201);

        //tell the user its works
        echo json_encode(array("message" => "Produkt wurde eingetragen."));
    }
}else{ //incomplete Data
    http_response_code(400);

    echo json_encode("message" => "Fehler beim eintragen des Produktes");
}
?>