<?php 
    $result = array();
    try {
        include 'connect.php';

        // file_get_contents($folderSQL . "getTable.sql")
        $table = $conn->query("select * from `tablej` where Country like 'f%'");
        $json = array();
        $index = 0;

        while ($row = mysqli_fetch_assoc($table)) {
            $result['format'] = 'data:image/png;base64,';
            $json['id'] = $row['id'];
            $json['Country'] = $row['Country'];
            $json['Capital'] = $row['Capital'];
            $json['Ruler'] = $row['Ruler'];
            $json['Population'] = $row['Population'];

            $json['Image Country'] = base64_encode($row['Image Country']);
            $json['Image Ruler'] = base64_encode($row['Image Ruler']);
            $json['Image Capita'] = base64_encode($row['Image Capital']);

            $result['table'][] = $json;
        }

        $result['status'] = true;

        $conn->close();
    }
    catch (Exception $e) {
        $result['Exception'] = $e;
        $result['status'] = false;
    }
    finally {
        echo json_encode($result);
    }
?>