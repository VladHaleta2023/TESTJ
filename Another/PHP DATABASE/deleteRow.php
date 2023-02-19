<?php 
    include "connect.php";

    $id = $_GET['id'];
    $result = mysqli_query($conn, "DELETE FROM `tablej` WHERE `id`='$id';");
    $conn->close();
?>