<?php
    $result = array();
    $result['connect']['user'] = $user = "root";
    $result['connect']['password'] = $password = "";
    $result['connect']['db'] = $db = "countries";
    $result['connect']['host'] = $host = "localhost";
    
    try {
        $conn = mysqli_connect(null, $user, $password, $db, null, $host);
    }
    catch (Exception $e) {
        $result['connect']['Exception'] = $e;
    }
    finally {
        json_encode($result);
    }
?>