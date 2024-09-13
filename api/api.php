<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include "connect.php";



$result = $db->prepare("SELECT * FROM data");
$result->bindParam(':userid', $res);
$result->execute();
for($i=0; $row = $result->fetch(); $i++){ 

 

    $result_array[] = array (

    "name" => $row['name'],
    "salary" => $row['salary'],
    "age" => $row['age'],);
}
 

 





echo (json_encode ( $result_array ));

?>