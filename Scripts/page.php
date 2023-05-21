<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../Header/icons.css">
    <link rel="stylesheet" href="../Header/styleHeader.css">
    <script src="../Table/VHD_server.js"></script>
    <link rel="stylesheet" href="page.css">
    <title>Page</title>
</head>
<body onload="loadPageTest()">
    <header id="header" style="position:sticky; z-index: 2;">
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
        123
    </main>
    <script src="../Header/header.js"></script>
    <script>
        function setSizesMain() {
            const main = document.querySelector("main");
            if (window.screen.width > 1000) {
                main.style.margin = `0px auto`;
                main.style.width = "900px";
            }
            else if (window.screen.width > 900) {
                main.style.margin = `0px auto`;
                main.style.width = "800px";
            }
            else if (window.screen.width > 400)
                main.style.margin = "0px 32px";
            else if (window.screen.width > 0)
                main.style.margin = "0px";
        }
        
        function loadPageTest() {
            setSizesMain();
        }

        function print() {
            let table = [];
            table[0] = Server.getTable()[1];
            table[1] = Server.getTable()[2];
            table[2] = Server.getTable()[3];
            table[3] = Server.getTable()[4];

            /*
                let result = Server.getTable();
                let format = Server.getResult().format;

                for (let i = 0; i < table.length; i++) {
                    result[i]['Country'];
                    result[i]['Population'];
                    result[i]['Ruler'];
                    result[i]['Capital'];
                    result[i]['Image Country'];
                    result[i]['Image Ruler'];
                    result[i]['Image Capital'];
                    result[i]['Area'];
                    result[i]['Religion'];
                    result[i]['Continent'];
                    result[i]['Currency'];
                    result[i]['GMT'];
                    result[i]['Short History'];
                }
            */
            console.log(table);
        }
    </script>
</body>
</html>