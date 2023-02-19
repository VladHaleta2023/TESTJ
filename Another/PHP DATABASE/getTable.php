<?php
    include "connect.php";

    $result = mysqli_query($conn, "SELECT * FROM tablej");

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><input id=\"". $row['id']."\" type=\"submit\" onclick=\"deleteRow(this)\" value=\"Delete\"><input id=\"". $row['id']."\" type=\"submit\" onclick=\"changeRow(this)\" value=\"Change\"></td>";
        echo "<td id=\"Country\">". $row['Country']."</td>";
        echo "<td>". $row['Population']."</td>";
        echo "<td>". $row['Rule']."</td>";
        echo "<td>". $row['Capital']."</td>";
        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Image_Country']) . "\"></td>";
        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Image_Rule']) . "\"></td>";
        echo "<td><img src=\"data:image/png;base64," . base64_encode($row['Image_Capital']) . "\"></td>";
        echo "</tr>";
    }

    $conn->close();
?>