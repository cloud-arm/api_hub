<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <h2>Enter Data</h2>

    <form method="POST" action="">
        <label for="mobile_no">Mobile No:</label>
        <input type="text" id="mobile_no" name="mobile_no" required>

        <label for="message">Message:</label>
        <input type="text" id="message" name="message" required>

        <input type="submit" value="Submit">
    </form>
    <div id="response">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $mobile_number = $_POST['mobile_no'];
            $message = $_POST['message'];
            

            $url = "http://localhost/api/massage_api.php";

            $data_array = array(
                "mobile_no" => $mobile_number,
                "message" => $message

            );

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data_array));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json'
            ));

            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);

            } else {

                $decoded = json_decode($response, true);

                echo "<h3>Response:</h3>";
                foreach ($decoded as $key => $val) {
                    echo ($key) . ': ' . ($val) . '<br>';
                }
            }

            curl_close($ch);
        }
        ?>
    </div>

</body>
</html>
