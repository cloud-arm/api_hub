<?php
require_once 'db_query/select.php';
require_once 'db_query/update.php';

function updateToken($tocken, $dt) {
    if ($dt == date('Y-m-d')) {
        return $tocken;
    } else {
        $t = tockan(); // Assuming tockan() returns an array with 'token' key
        $tocken = $t['token'];
        update('tocken', ['tocken' => $tocken, 'date' => date('Y-m-d')], ''); // Update the token in DB
        return $tocken; // Return the updated token
    }
}
?>
