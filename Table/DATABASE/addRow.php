<?php 
    try {
        include 'connect.php';

        if (isset($_REQUEST['newCountry']))
            $newCountry = $_REQUEST['newCountry'];
        
        $table = $conn->query("INSERT INTO `tablej` (`Country`) VALUES ('".$newCountry."');");

        $result['status'] = true;
        $result['Exception'] = "None";
        
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