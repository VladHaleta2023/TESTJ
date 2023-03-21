<?php
    try {
        include 'connect.php';

        if (isset($_REQUEST['id']))
            echo $id = $_REQUEST['id'];

        $table = $conn->query("delete from `tablej` where `id` = '". $id ."';");

        $result['Exception'] = "None";
        $result['status'] = true;

        $conn->close();
    }
    catch (Exception $e) {
        $result['Exception'] = $e;
        $result['status'] = false;
    }
    finally {
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
    }
?>