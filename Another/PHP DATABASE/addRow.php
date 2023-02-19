<?php 
    include "connect.php";

    $json = array(
        'id' => null,
        'addHTML' => false
    );

    $result = $conn->query("SELECT * FROM `tablej` WHERE `Country`='';");
    
    if ($result->num_rows == 0) {
        $result = mysqli_query($conn, "INSERT INTO `tablej` (`Country`) VALUES ('');");
        $json['id'] = $conn->insert_id;
        $json['addHTML'] = true;
    }

    $conn->close();
    echo json_encode($json);
?>