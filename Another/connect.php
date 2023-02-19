<?php
    $user = getenv('CLOUDSQL_USER');
    $password = getenv('CLOUDSQL_PASSWORD');
    $db = getenv('CLOUDSQL_DB');
    $instance = getenv('CLOUDSQL_DSN');
    $conn = mysqli_connect(null, $user, $password, $db, null, $instance);
?>