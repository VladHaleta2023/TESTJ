<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TestJ</title>
    <link rel="stylesheet" href="Styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>
<body onload="showTable()">

<!--
    <table id="mainTable">
        <thead>
            <th>
                <input onclick="addRow()" id="AddRow" type="submit" value="Add Row"/>
            </th>
            <th style="display: none;"></th>
            <th>Country</th>
            <th>Population</th>
            <th>Rule</th>
            <th>Capital</th>
            <th>Image Country</th>
            <th>Image Rule</th>
            <th>Image Capital</th>
        </thead>
        <tbody id="tbody"></tbody>
    </table>
-->
</body>

<script>
    let changeTableBool = false;
    let changeRowClose = true;

    function showTable() {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById("tbody").innerHTML = this.responseText;
        }
        xmlhttp.open("POST", "PHP DATABASE/getTable.php");
        xmlhttp.send();
    }

    function formChangeRowClose() {
        changeRowClose = true;
        let form = document.getElementById("formChangeRow");
        setTimeout(() => {form.remove();}, 100);
    }

    function changeRow(event) {
        if (changeRowClose) {
            changeRowClose = false;
            document.body.innerHTML += `
            <div class="formChangeRow" id="formChangeRow">
                <div class="header_formChangeRow">
                    <div class="symbol cross" onclick="formChangeRowClose()">&#10006;</div>
                </div>
                <form >
                </form>
            </div>
            </>`;
        
        

            /*
            $.ajax({
                url: "PHP DATABASE/changeRow.php",
                dataType: "JSON",
                type: "POST",
                data: {

                },
                success: function(data) {
                    if (data.addHTML == true) {
                        let tbody = document.getElementById("tbody");
                        tbody.innerHTML = `
                        <tr>
                        <td>
                        <input id=\"${data.id}\" type=\"submit\" onclick=\"deleteRow(this)\" value=\"Delete\">
                        <input id=\"${data.id}\" type=\"submit\" onclick=\"changeRow(this)\" value=\"Change\">
                        </td>
                        <td></td>
                        <td>0</td>
                        <td></td>
                        <td></td>
                        <td><img src=\"data:image/png;base64," . base64_encode($row['Image_Country']) . "\"></td>
                        <td><img src=\"data:image/png;base64," . base64_encode($row['Image_Rule']) . "\"></td>
                        <td><img src=\"data:image/png;base64," . base64_encode($row['Image_Capital']) . "\"></td>
                        </tr>` + tbody.innerHTML;
                    }
                }
            });
            */
        }
    }

    function deleteRow(event) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            return;
        }
        xmlhttp.open("GET", "PHP DATABASE/deleteRow.php?id=" + event.id);
        xmlhttp.send();

        $("#" + event.id).parent().parent().remove();
    }

    function addRow() {
        let contents;

        $.ajax({
            url: "PHP DATABASE/addRow.php",
            dataType: "json",
            type: "post",
            data: contents,
            success: function(data) {
                if (data.addHTML == true) {
                    let tbody = document.getElementById("tbody");
                    tbody.innerHTML = `
                    <tr>
                    <td>
                    <input id=\"${data.id}\" type=\"submit\" onclick=\"deleteRow(this)\" value=\"Delete\">
                    <input id=\"${data.id}\" type=\"submit\" onclick=\"changeRow(this)\" value=\"Change\">
                    </td>
                    <td></td>
                    <td>0</td>
                    <td></td>
                    <td></td>
                    <td><img src=\"data:image/png;base64," . base64_encode($row['Image_Country']) . "\"></td>
                    <td><img src=\"data:image/png;base64," . base64_encode($row['Image_Rule']) . "\"></td>
                    <td><img src=\"data:image/png;base64," . base64_encode($row['Image_Capital']) . "\"></td>
                    </tr>` + tbody.innerHTML;
                }
            }
        });
    }
</script>

</html>

