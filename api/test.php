<?php
function sendSMS($phoneNumber, $message) {
    // Generate the transaction_id based on the current date and time (e.g., 202408150945)
    $transactionId = date('YmdHis');
    
    // Set up the payload
    $postData = json_encode([
        "sourceAddress" => "CLOUD ARM",
        "message" => $message,
        "transaction_id" => $transactionId,
        "payment_method" => "0",
        "msisdn" => [
            ["mobile" => $phoneNumber]
        ],
        "push_notification_url" => "https://xxx/xx?"
    ]);
    
    // Initialize cURL session
    $curl = curl_init();

    // Set cURL options
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://e-sms.dialog.lk/api/v2/sms',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6MTMyODAsInVzZXJuYW1lIjoiZXJhbmRhIiwibW9iaWxlIjo3NzkyNTI1OTQsImVtYWlsIjoiZXJhbmRhc2FtcGF0aDIwMDBAZ21haWwuY29tIiwiY3VzdG9tZXJfcm9sZSI6MCwiaWF0IjoxNzIzNjk0NzE5LCJleHAiOjE3MjM3Mzc5MTl9.5P_BrG81IlqSTTkQ5F3U43A1StAwMQsmjndxfa-2cCs',
            'Content-Type: application/json'
        ),
    ));

    // Execute the cURL request
    $response = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        echo 'Error:' . curl_error($curl);
    }

    // Close cURL session
    curl_close($curl);

    // Return the response from the API
    return $response;
}

// Example usage
$phoneNumber = '716985407';
$message = 'Your verification code is 1234';
$response = sendSMS($phoneNumber, $message);

echo $response;

?>