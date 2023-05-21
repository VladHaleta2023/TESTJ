<?php 
    $result = array();
    $result['connect']['user'] = $user = "root";
    $result['connect']['password'] = $password = "";
    $result['connect']['db'] = $db = "countries";
    $result['connect']['host'] = $host = "localhost";
    $result['connect']['coding'] = 'utf8';

    try {
        $conn = mysqli_connect(null, $user, $password, $db, null, $host);
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../Header/icons.css">
    <link rel="stylesheet" href="../Header/headerStyle.css">
    <link rel="stylesheet" href="tableStyles.css">
    <link rel="stylesheet" href="updateRow.css">
    <link rel="stylesheet" href="connectServer.css">
    <script src="VHD_server.js"></script>
    <script src="VHD_client.js"></script>
    <title>Table</title>
</head>
<body onload="loadTable()">
    <style>
        div.message {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            font-size: 24px;
            padding: 16px;
            width: var(--width-showMessage);
            position: relative;
        }

        .table thead {
            position: sticky;
            top: 96px;
            z-index: 1;
        } 

        .formRowInfo {
            background-color: white;
            display: none;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            position: absolute;
            padding: 32px 0px;
            padding-top: 64px !important;
            top: 96px;
            left: 0;
        }

        table.rowInfoTable {
            border-collapse: collapse;
            border: 0;
            width: 100%;
            height: calc(100% + 128px);
            margin-top: 0px !important;
            word-break: break-all;
        }

        form {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            justify-content: center; 
            align-items: center;
            width: 100%;
        }

        main section.messages {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: fixed;
            z-index: 2;
            width: 300px;
            top: 0;
        }

        .headerRowInfo {
            display: flex; 
            flex-direction: row;
        }

        @media only screen and (max-width: 700px)  {
            table.rowInfoTable tr {
                display: flex !important;
                flex-direction: column !important;
            }

            section#formRowInfo i.material-icons {
                font-size: 24px !important;
                margin-right: 4px !important;
            }

            table.rowInfoTable td.property, table.rowInfoTable td.value {
                width: 100% !important;
                text-align: center !important;
                padding: 12px !important;
            }

            .textInputRowInfo {
                width: 100% !important;
                text-align: center !important;
            }

            .textInputRowInfo:focus {
                text-align: start !important;
            }

            .rowInfo {
                font-size: 24px !important;
            }

            label.idRow {
                font-size: 20px !important;
            }

            .btnRowInfo {
                font-size: 24px !important;
            }

            div.centerPosition {
                justify-content: center !important;
            }
        }

        @media only screen and (max-width: 420px) {
            .table thead {
                position: sticky;
                top: 64px;
                z-index: 1;
            } 

            header .imgCompany {
                width: 32px !important;
                height: 32px !important;
            }
        }

        @media only screen and (max-width: 400px) {
            .rowInfo {
                flex-direction: column !important;
            }

            .headerRowInfo {
                margin-bottom: 12px !important;
            }
        }
    </style>
    <header id="header" style="position: sticky; z-index: 1; top: 0;">
        <nav>
            <div class="phone-Content">
                <button class="phone-Btn" onclick="Header.clickBtnPhone(this)">
                    <i class="material-icons" style="font-size: 42px; color: white; padding-top: 6px;">dehaze</i>
                </button>
                <ul>
                    <li>
                        <a class="pages" href="../Another/globalClass.php">
                            <i class="material-icons header-icon opacityAnimation" style="padding-bottom: 2px;">home</i>
                            <span class="header-span">HOME</span>
                        </a>
                    </li>
                    <li>
                        <a class="pages" href="../Generate Test/generateTest.html">
                            <i class="material-icons header-icon opacityAnimation">live_help textsms</i>
                            <span class="header-span" style="font-weight: bold;">TEST</span>
                        </a>
                    </li>
                    <li>
                        <a class="pages" href="../Table/table.php">
                            <i class="material-icons header-icon roundAnimation">settings</i>
                            <span class="header-span">CUSTOMIZE</span>
                        </a>
                    </li>
                </ul>            
            </div>
            <a href="https://github.com/VladHaleta2023" target="_blank">
                <div class="symbolCompany">
                    <img class="imgCompany" src="../CompanyImg.png" alt="CompanyImg">
                    <span class="textCompany">VLH 2023 ALL RIGHTS RESERVED ©</span>
                </div>
            </a>
        </nav>
    </header>
    <main>
        <section class="topManage">
            <button class="setBtn add" onclick="ClientAddRow.showMesRowAdd()">
                <i class="material-icons">add</i>
                <span class="textSetBtn">New Row</span>
            </button>
            <div class="search" onkeypress="keyEnter(event)">
                <input class="searchTable" type="text" id="searchTable" placeholder="Country...">
            </div>
        </section>
        <section class="messages" id="messages"></section>
        <section class="formRowInfo" id="formRowInfo">
            <form action="table.php" method="POST" enctype="multipart/form-data">
                <div class="rowInfo">
                    <div class="headerRowInfo">
                        <span style="margin-right: 16px;">Row Info</span>
                        <input style="display: none;" type="text" name="idRow" id="idRow">
                        <label for="idRow" class="idRow" id="labelIdRow"></label>
                    </div>
                    <div style="display: flex; flex-direction: row;">
                        <input type="submit" style="display: none;" name="upload" id="btnSaveCountry" value="Save">
                        <label onclick="closeRowInfo()" title="Save Data Or Close Form" for="btnSaveCountry" class="btnRowInfo green">
                            <i style="margin-right: 8px; font-size: 32px;" class="material-icons">done</i>
                            <span>Done</span>
                        </label>
                    </div>
                </div>
                <table class="rowInfoTable">
                    <tbody>
                        <tr>
                            <td class="property">Country</td>
                            <td class="value" style="background-color: #ddd;" id="countryValue"></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 32px;">
                                <img id="imgCountry" 
                                    class="rowIngoImg"
                                    src="" 
                                    alt="Error Image Flag">
                                <div class="centerPosition">
                                    <input type="file" style="display: none;" name="fileImgCountry" id="saveCountry" 
                                    onchange='chooseFile("Country")'>
                                    <label title="Choose Image" for="saveCountry" class="btnRowInfo orange">
                                        <i style="margin-right: 8px;" class="material-icons">folder</i>
                                        <span>Choose</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Capital</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textCapital" id="textCapital">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 32px;">
                                <img id="imgCapital" 
                                    class="rowIngoImg"
                                    src="" 
                                    alt="Error Image Capital">
                                <div class="centerPosition">
                                    <input type="file" style="display: none;" name="fileImgCapital" id="saveCapital" 
                                    onchange='chooseFile("Capital")'>
                                    <label title="Choose Image" for="saveCapital" class="btnRowInfo orange">
                                        <i style="margin-right: 8px;" class="material-icons">folder</i>
                                        <span>Choose</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Population</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textPopulation" id="textPopulation">
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Ruler</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textRuler" id="textRuler">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding: 32px;">
                                <img id="imgRuler" 
                                    class="rowIngoImg"
                                    src="" 
                                    alt="Error Image Ruler">
                                <div class="centerPosition">
                                    <input type="file" style="display: none;" name="fileImgRuler" id="saveRuler" 
                                    onchange='chooseFile("Ruler")'>
                                    <label title="Choose Image" for="saveRuler" class="btnRowInfo orange">
                                        <i style="margin-right: 8px;" class="material-icons">folder</i>
                                        <span>Choose</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Area (<span>km<sup>2</sup></span>)</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textArea" id="textArea">
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Religion</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textReligion" id="textReligion">
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Continent</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textContinent" id="textContinent">
                            </td>
                        </tr>
                        <tr>
                            <td class="property">GMT</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textGMT" id="textGMT">
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Currency</td>
                            <td class="value">
                                <input class="textInputRowInfo" type="text" name="textCurrency" id="textCurrency">
                            </td>
                        </tr>
                        <tr>
                            <td class="property">Short History</td>
                            <td class="value">
                                <textarea rows="10" class="textInputRowInfo" name="textHistory" id="textHistory"></textarea>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php 
                    if (isset($_POST['upload']) AND isset($_POST['idRow'])) {
                        $id = $_POST['idRow'];
                        if (!empty($_FILES['fileImgCountry']['tmp_name'])) {
                            $imgCountry = addslashes(file_get_contents($_FILES['fileImgCountry']['tmp_name']));
                            $conn->query("UPDATE `tablej` SET `Image Country` = '". $imgCountry ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textPopulation'])) {
                            $Population = $_POST['textPopulation'];
                            $conn->query("UPDATE `tablej` SET `Population` = '". $Population ."' WHERE `id` = '". $id ."'");
                        }
                        if (!empty($_FILES['fileImgCapital']['tmp_name'])) {
                            $imgCapital = addslashes(file_get_contents($_FILES['fileImgCapital']['tmp_name']));
                            $conn->query("UPDATE `tablej` SET `Image Capital` = '". $imgCapital ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textCapital'])) {
                            $Capital = $_POST['textCapital'];
                            $conn->query("UPDATE `tablej` SET `Capital` = '". $Capital ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textRuler'])) {
                            $Ruler = $_POST['textRuler'];
                            $conn->query("UPDATE `tablej` SET `Ruler` = '". $Ruler ."' WHERE `id` = '". $id ."'");
                        }
                        if (!empty($_FILES['fileImgRuler']['tmp_name'])) {
                            $imgRuler = addslashes(file_get_contents($_FILES['fileImgRuler']['tmp_name']));
                            $conn->query("UPDATE `tablej` SET `Image Ruler` = '". $imgRuler ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textArea'])) {
                            $Area = $_POST['textArea'];
                            $conn->query("UPDATE `tablej` SET `Area` = '". $Area ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textReligion'])) {
                            $Religion = $_POST['textReligion'];
                            $conn->query("UPDATE `tablej` SET `Religion` = '". $Religion ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textContinent'])) {
                            $Continent = $_POST['textContinent'];
                            $conn->query("UPDATE `tablej` SET `Continent` = '". $Continent ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textGMT'])) {
                            $GMT = $_POST['textGMT'];
                            $conn->query("UPDATE `tablej` SET `GMT` = '". $GMT ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textCurrency'])) {
                            $Currency = $_POST['textCurrency'];
                            $conn->query("UPDATE `tablej` SET `Currency` = '". $Currency ."' WHERE `id` = '". $id ."'");
                        }
                        if (isset($_POST['textHistory'])) {
                            $History = $_POST['textHistory'];
                            $conn->query("UPDATE `tablej` SET `Short History` = '". $History ."' WHERE `id` = '". $id ."'");
                        }
                    }
                ?>
            </form>
        </section>
    </main>
    <script src="../Header/header.js"></script>
    <script>
        function keyEnter(event) {
            try {
                if (event.code == "Enter" || event.code == "NumpadEnter")
                    ClientTable.loadTable();
            }
            catch {
                return undefined;
            }
        }

        function chooseFile(name) {
            var file = document.querySelector("input#save" + String(name)).files[0];
            var reader = new FileReader();
            reader.addEventListener(
                'load',
                () => {
                    const img = document.querySelector("img#img" + String(name));
                    img.src = reader.result;
                },
                false);
            reader.readAsDataURL(file);
        }

        function closeRowInfo() {
            const fileImgCountry = document.querySelector("input#saveCountry");
            fileImgCountry.setAttribute("value", "");

            document.body.style.position = "relative";
            document.querySelector("section#formRowInfo").style.display = "none";
            document.querySelector("section.topManage").style.display = "flex";
            document.querySelector("table.table").style.display = "table";
        }

        function showFormRowInfo() {
            try {
                const root = document.querySelector(":root");
                const propertiesRoot = getComputedStyle(root);
                const thead = document.querySelector("table.table>thead");
                thead.style.position = "static";
                const watchRow = document.querySelector("main>section.formRowInfo");
                const form = document.querySelector("main>section.formRowInfo>form");
                if (window.screen.width > 1000) {
                    watchRow.style.padding = `0px auto`;
                    form.style.width = String(window.screen.width - 200) + "px";
                }
                else if (window.screen.width > 900) {
                    watchRow.style.padding = `0px auto`;
                    form.style.width = String(window.screen.width - 100) + "px";
                }
                else if (window.screen.width > 700)
                    watchRow.style.padding = `0px 32px`;
                else if (window.screen.width > 0) {
                    watchRow.style.padding = "0px";
                }

                watchRow.style.display = "flex";
                watchRow.style.width = String(window.screen.width) + "px";
                watchRow.style.height = String(window.screen.height) + "px";
            }
            catch {
                return undefined;
            }
        }

        function getRowInfo(tagElement) {
            window.scrollTo(0, 0);

            const element = Element.getById(tagElement.id);
            showFormRowInfo();
            document.querySelector("section.topManage").style.display = "none";
            document.querySelector("table.table").style.display = "none";
            
            const formRowInfo = document.querySelector("section#formRowInfo");
            const imgCountry = document.querySelector("img#imgCountry");
            const imgCapital = document.querySelector("img#imgCapital");
            const imgRuler = document.querySelector("img#imgRuler");
            const idRow = document.querySelector("div.rowInfo>div>input#idRow");
            const labelIdRow = document.querySelector("div.rowInfo>div>label#labelIdRow");
            const textCountry = document.querySelector("td#countryValue");
            const textPopulation = document.querySelector("input#textPopulation");
            const textCapital = document.querySelector("input#textCapital");
            const textRuler = document.querySelector("input#textRuler");
            const textArea = document.querySelector("input#textArea");
            const textReligion = document.querySelector("input#textReligion");
            const textContinent = document.querySelector("input#textContinent");
            const textGMT = document.querySelector("input#textGMT");
            const textCurrency = document.querySelector("input#textCurrency");
            const textHistory = document.querySelector("textarea#textHistory");

            textCountry.innerHTML = String(element.Country);
            textHistory.innerHTML = String(element['Short History']);
            idRow.setAttribute("value", String(element.id));
            textPopulation.setAttribute("value", String(element.Population));
            textReligion.setAttribute("value", String(element.Religion));
            textRuler.setAttribute("value", String(element.Ruler));
            textArea.setAttribute("value", String(element.Area));
            textContinent.setAttribute("value", String(element.Continent));
            textGMT.setAttribute("value", String(element.GMT));
            textCurrency.setAttribute("value", String(element.Currency));
            labelIdRow.innerHTML = "#" + String(element.id);
            imgCountry.setAttribute("src", `${String(Table.getResult().format)} ${String(element['Image Country'])}`);
            imgCapital.setAttribute("src", `${String(Table.getResult().format)} ${String(element['Image Capital'])}`);
            imgRuler.setAttribute("src", `${String(Table.getResult().format)} ${String(element['Image Ruler'])}`);
            textCapital.setAttribute("value", String(element.Capital));
        }

        function setSizes() {
            const main = document.querySelector("main");
            const root = document.querySelector(':root');
            root.style.setProperty("--widthMain", main.clientWidth + "px");
            root.style.setProperty("--width-showMessage", window.screen.width + "px");

            const searchInput = document.querySelector("main>section.topManage>div.search>input#searchTable");
            const widthInput = main.clientWidth;
            searchInput.style.width = widthInput + "px";
        }

        function consoleInfo() {
            console.log(Server.getResult());
            console.log(Server.getTable());
        }

        function loadTable() {
            const main = document.querySelector("main");
            ClientTable.loadTable();

            if (window.screen.width > 1000) {
                main.style.margin = `0px auto`;
                main.style.width = String(window.screen.width - 200) + "px";
            }
            else if (window.screen.width > 900) {
                main.style.margin = `0px auto`;
                main.style.width = String(window.screen.width - 100) + "px";
            }
            else if (window.screen.width > 700)
                main.style.margin = "0px 32px";
            else if (window.screen.width > 0)
                main.style.margin = "0px";

            setSizes();
        }
    </script>
</body>
</html>