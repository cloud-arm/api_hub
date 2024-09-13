<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .btn-info {
            background-color: #17a2b8;
        }
    </style>
</head>
<body>

    <h2>Data List</h2>

    <table>
        
        <tbody>
        <?php
            // Initialize cURL session
            $ch = curl_init();

            // Set the API URL
            $url = "http://localhost/api/massage_api.php?action=get";

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Execute cURL and get the response
            $resp = curl_exec($ch);

            // Check for errors
            if ($e = curl_error($ch)) {
                echo "<tr><td colspan='2'>Error: $e</td></tr>";
            } else {
                // Decode the JSON response
                $decoded = json_decode($resp, true);
                print_r($decoded);


            }

            // Close cURL session
            curl_close($ch);
            ?>

        </tbody>
    </table>

