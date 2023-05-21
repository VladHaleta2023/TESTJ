<?php
    $result = array();
    $result['connect']['user'] = $user = "root";
    $result['connect']['password'] = $password = "";
    $result['connect']['db'] = $db = "countries";
    $result['connect']['host'] = $host = "localhost";
    $result['connect']['coding'] = 'utf8';

    try {
        $conn = mysqli_connect(null, $user, $password, $db, null, $host);
    }
    catch (Exception $e) {
        die ("Error DataBase");
    }

    try {
        $conn->set_charset('utf8');
        $result['connect']['status'] = true;
        $result['format'] = 'data:image/*;base64,';
    }
    catch (Exception $e) {
        $result['connect']['Exception'] = $e;
        $result['connect']['status'] = false;
        $result['format'] = 'data:image/jpeg;base64,';
    }
?>