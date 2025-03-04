<?php

function insert($table, $data, $path = "", $file_name = "")
{
    include($path . 'connect.php');

    $keys = implode(', ', array_keys($data['data']));
    $values = ':' . implode(', :', array_keys($data['data']));

    $sql = "INSERT INTO $table ($keys) VALUES ($values)";

    try {
        $stmt = $db->prepare($sql);
        $stmt->execute($data['data']);

        $res = array(
            "status" => "success",
            "message" => "Data Insert Successful ..!",
        );
        return $res;
    } catch (PDOException $e) {

        // create error json log
        $json = array(
            "file" => $file_name,
            "table" => $table,
            "message" => $e->getMessage(),
            "date" => date("Y-m-d"),
            "time" => date('H:i:s'),
        );
        // log_init('error', $json, 'json', $path);

        // Get the database name
        $stmt = $db->query("SELECT DATABASE()");
        $dbName = $stmt->fetchColumn();

        // create message
        $message = "Please check error log..!    ( File: " . $e->getFile() . " On line: " . $e->getLine() . " )  ( Message: " . $e->getMessage() . " )  ( Table Name: "  . $table . " )  ( Database Name: "  . $dbName . " )";

        // create discord alert
        discord($message);

        // create whatsapp alert
        // $contact = '94762020312';
        // $contact = '94772955659';
        // whatsApp($contact, $message);

        // Create txt log
        //$content = "cloud_id: 0, app_id: " . $data['data']['app_id'] . ", data_id: " . $data['other']['data_id'] . ", data_name: " . $data['other']['data_name'] . ", status: failed, message: " . $e->getMessage() . ", Date: " . date('Y-m-d') . ", Time: " . date('H:s:i');
        // log_init($table, $content, 'txt', $path);

        $res = array(
            "status" => "failed",
            "message" => $e->getMessage(),
        );
        return $res;
    }
}
