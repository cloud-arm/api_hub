<?php
require_once 'connect.php';
require_once 'toctocken.php';
require ('db_query/select.php');
require ('db_query/update.php');
require('tocken_update.php');

function dialogSMS($phoneNumber, $message, $sender_id){

$curl = curl_init();
$transactionId = date('YmdHis');

$result = select('tocken', '*', '');

$tocken = '';
$dt = '';

for($i=0; $row = $result -> fetch(); $i++){
    $tocken = $row['tocken'];
    $dt = $row['date'];
}

/*
if($dt == date('Y-m-d')){
    $tocken = $tocken;
}else{
    $t = tockan();
    $tocken = $t['token'];

    update('tocken', ['tocken' => $tocken, 'date' => date('Y-m-d')],'');

}
    */

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://e-sms.dialog.lk/api/v2/sms',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"sourceAddress": "'.$sender_id.'",
"message": "'. $message .'",
"transaction_id": "'.$transactionId.'",
"payment_method": "0",
"msisdn": [
{
"mobile": "'.$phoneNumber.'"
}
],
"push_notification_url": " https://xxx/xx?"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer ' . $tocken,  // Use dynamic token
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);

$responseData = json_decode($response, true);

return $responseData;

    // Assuming the response contains 'status' and 'comment' keys
    $status = isset($responseData['status']);
    $comment = isset($responseData['comment']);
    $cost = isset($responseData['campaignCost']);

    // Return the status and comment
    return array(
        'status' => $status,
        'comment' => $comment,
        'campaignCost'=>$cost
    );

}

function textitSMS($phoneNumber, $message){

}

function shoutoutSMS($phoneNumber, $message){

}

function deviceSMS($phoneNumber, $message){

}

?>
