<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <title>Table</title>
</head>
<body onload="loadTable()">
    <main>
        <section class="topManage">
            <button class="setBtn">
                <i class="material-icons" class="add">add</i>
                <span class="textSetBtn">Add Row</span>
            </button>
            <input class="searchTable" type="search" id="searchTable" oninput="loadSearchTable(this)" placeholder="Search...">
        </section>
    </main>
    <script>
        function loadTable() {
            const main = document.querySelector("main");

            let contents;
            let result = null;

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);
                const table = result['table'];

                if (table != undefined) {
                    try {
                        main.innerHTML += 
                        `<table class="table">
                            <thead>
                                <th></th>
                                <th>Country</th>
                            </thead>
                            <tbody id="dataTable"></tbody>
                        </table>`;

                        const tbody = document.querySelector("tbody#dataTable");
                        for (let i = 0; i < table.length; i++) {
                            tbody.innerHTML += 
                        `   <tr onclick="getRowInfo(this)" id="${table[i]['id']}">
                                <td class="settings">
                                    <i onclick="deleteRow(this)" id="${table[i]['id']}" class="material-icons delete">delete</i>
                                    <i onclick="changeRow(this)" id="${table[i]['id']}" class="material-icons change">create</i>
                                </td>
                                <td class="country" id="Country">${table[i]['Country']}</td>
                            </tr>
                            `;
                        }
                    }
                    catch {
                        return;
                    }
                }
                else
                    main.innerHTML += `<span class="notFound">Not Found</span>`;
            }
            xmlhttp.open("GET", "DATA/getTable.php", true);
            xmlhttp.send();
        }
    </script>
</body>
</html>