<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include "connect.php";  
include "function.php"; 
include "sms.php";
include "db_query/insert.php";

$request = $_SERVER["REQUEST_METHOD"];

if ($request == 'POST') {
    $inputData = json_decode(file_get_contents("php://input"), true);
    
    if (isset($inputData['mobile_no']) && isset($inputData['message'])) {
        $mobile_number = $inputData['mobile_no'];
        $message = $inputData['message'];
        $sender_id = $inputData['send_id'];
        $customer_type = $inputData['customer_type'];
        
        // Save data function
       $r = dialogSMS($mobile_number, $message, $sender_id ,$customer_type);
       $status = $r['status'];
       $comment = $r['comment'];
      //$campaignCost = $r['campaignCost'];

        //$response = insertdata($mobile_number, $message);

        $insertData = array(
            "data" => array(
                "mobile_no" => $mobile_number,
                "message" => $message,
                "status" => $status,
                "comment" => $comment,
                "customer_type"=>$customer_type,
                //"cost" => $campaignCost,
                "send_id" => $sender_id


            ),
            "other" => array(
            ),
        );
        
        // Insert the data into the sales_list table
        $response=insert("mobile", $insertData, '');

        
        
        $data = [
            'status' => 200,
            'message' => $r,
            'save' => $response,
        ];
        echo json_encode($data);

    } else {
        
        $data = [

            'status' => 400,
            'message' => 'Invalid input data',
        ];

        echo json_encode($data);
    }

} elseif ($request == 'GET') {
    if ($request == 'GET') {
       // $mobile_number = $_GET['mobile_no'];
        
       
        $response = getData();
        
        $data = [
            'status' => 200,
            'message' => $response,
        ];
        echo json_encode($data);
    } else {
        $data = [
            'status' => 400,
            'message' => 'Mobile number not provided',
        ];
        echo json_encode($data);
    }

} else {
    $data = [
        'status' => 405,
        'message' => $request . ' not allowed',
    ];
    
    header("HTTP/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>
