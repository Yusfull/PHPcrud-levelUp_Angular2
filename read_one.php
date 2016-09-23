<?php

// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
// get database connection
$database = new \Database();
$db = $database->getConnection();
// prepare product object
$product = new \Product($db);
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
// set ID property of product to be edited
$product->id = $data->id;
// read the details of product to be edited
$product->readOne();
// create array
$product_arr[] = array("id" => $product->id, "name" => $product->name, "description" => $product->description, "price" => $product->price);
// make it json format
print_r(json_encode($product_arr));