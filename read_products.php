<?php 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
 
// include database and object files 
include_once 'config/database.php'; 
include_once 'objects/product.php'; 
 
// instantiate database and product object 
$database = new Database(); 
$db = $database->getConnection();
  
// initialize object
$product = new Product($db);
  
// query products
$stmt = $product->readAll();
$num = $stmt->rowCount();
  
$data="";
 
// check if more than 0 record found
if($num>0){
      
    $x=1;
      
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
          
        $data .= '{';
            $data .= '"id":"'  . $id . '",';
            $data .= '"name":"' . $name . '",';
            $data .= '"description":"' . html_entity_decode($description) . '",';
            $data .= '"price":"' . $price . '"';
        $data .= '}'; 
          
        $data .= $x<$num ? ',' : ''; $x++; } 
} 
 
// json format output 
echo '{"records":[' . $data . ']}'; 
?>