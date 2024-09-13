<?php

function insertdata($mobile_number, $message) {
    global $db; 


       
        $sql = "INSERT INTO mobile (mobile_no, message) VALUES (:mobile_no, :message)";
        $stmt = $db->prepare($sql);
        
       
        $stmt->execute(['mobile_no' => $mobile_number, 'message' => $message]);

        return "Data saved successfully!";
    
}



function getData() {
    global $db; 

    try {
        $result = $db->prepare("SELECT * FROM mobile");
        $result->execute();

        $result_array = [];
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $result_array[] = array(
                "mobile_no" => $row['mobile_no'],
                "message" => $row['message'],
              
            );
        }

        return json_encode($result_array);

    } catch (PDOException $e) {
        return json_encode(["error" => "Error retrieving data: " . $e->getMessage()]);
    }
}
?>
