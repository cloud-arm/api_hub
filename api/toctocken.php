<?php
function tockan(){
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://e-sms.dialog.lk/api/v1/login',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => 'username=8899&password=mmkrB.',
  CURLOPT_HTTPHEADER => array(
    'Apikey: ',
    'Content-Type: application/x-www-form-urlencoded'
  ),
));

$response = curl_exec($curl);

$responseData = json_decode($response, true);

return $responseData;

    // Assuming the response contains 'status' and 'comment' keys
    $tocken = isset($responseData['token']);
    $token_id = isset($responseData['id']);
    $status = isset($responseData['status']);

    // Return the status and comment
    return array(
        'token' => $tocken,
        'id' => $token_id,
        'status'=>$status
    );


}