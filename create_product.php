<?php

// get database connection
include_once 'config/database.php';
$database = new \Database();
$db = $database->getConnection();
// instantiate product object
include_once 'objects/product.php';
$product = new \Product($db);
// get posted data
$data = json_decode(file_get_contents("php://input"));
// set product property values
$product->name = $data->name;
$product->price = $data->price;
$product->description = $data->description;
$product->created = date('Y-m-d H:i:s');
// create the product
if ($product->create()) {
    echo "Product was created.";
} else {
    echo "Unable to create product.";
}