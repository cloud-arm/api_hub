<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: post");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



include "connect.php";

$request = $_SERVER["REQUEST_METHOD"];


if($request == 'POST'){
    $inputData = json_decode(file_get_contents("php://input"), true);
    echo $inputData['name'];
    echo $inputData['salary'];
    echo $inputData['age'];
}


    else
    {

        $data = [
            'status' => 405,
            'message' => $request. 'not allowed',
        ];
        
        header("HTTP/1.0 405 not allowed");
        echo json_encode($data);
    }
 

 







?>