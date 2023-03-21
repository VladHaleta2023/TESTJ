delRowShow = false;
firstAddShow = true;

class ClientTable {
    static clearTable() {
        const main = document.querySelector("main");
        try {
            main.querySelector("span.notFound").remove();
        }
        catch {}
        try {
            main.querySelector("table#table").remove();
        }
        catch {
            return undefined;
        }
    }

    static sortTable() {
        const tagElement=document.querySelector("i.material-icons.sort");
        return (tagElement.innerHTML == "keyboard_arrow_down") ? ClientTable.loadTable("keyboard_arrow_up") : ClientTable.loadTable();
    }

    static loadTable(sortValue = "keyboard_arrow_down") {
        try {
            const main = document.querySelector("main");
            ClientTable.clearTable();
            const searchText = document.querySelector("input#searchTable").value;

            let contents;
            let json = null;

            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const json = JSON.parse(this.responseText);
                const result = json['table'];

                if (result.length != 0) {
                    try {
                        main.innerHTML += 
                        `<table id="table" class="table">
                            <thead>
                                <th style="display: flex; align-items: center;">
                                    <span>Country</span>
                                    <i onclick="ClientTable.sortTable()" class="material-icons sort">${sortValue}</i>
                                </th>
                                <th style="width: 70px;"></th>
                            </thead>
                            <tbody id="dataTable"></tbody>
                        </table>`;

                        const tbody = document.querySelector("tbody#dataTable");
                        let countries = [];

                        for (let i = 0; i < result.length; i++)
                            countries.push({Country: result[i]['Country'], id: result[i]['id']});

                        if (sortValue == "keyboard_arrow_up")
                            countries.reverse();

                        for (let i = 0; i < result.length; i++) {
                            tbody.innerHTML += 
                        `   <tr>
                                <td class="country" onclick="getRowInfo(this)" id="${countries[i]['id']}">${countries[i]['Country']}</td>
                                <td class="settings">
                                    <i onclick="ClientDeleteRow.deleteRow(this)" id="${countries[i]['id']}" class="material-icons delete">delete</i>
                                </td>
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
            xmlhttp.open("POST", "DATABASE/getTableBySort.php");
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded;charset=utf-8");
            xmlhttp.send("searchText=" + searchText);
            document.querySelector("input#searchTable").setAttribute("value", searchText);
            document.querySelector("input#searchTable").removeAttribute("tabIndex");
        }
        catch {
            return undefined;
        }
    }
}

class ClientAddRow {
    static closeFormAddRow(addSucess=false) {
        try {
            const messages = document.querySelector("section#messages");
            let animationTime = 0.8, removeTime = 600;
            if (addSucess) {
                animationTime = 1.2;
                removeTime = 1100;
            } 
            messages.querySelector("div#addRow").style.animation = `closeMessage ${animationTime}s`;
            setTimeout(() => {messages.querySelector("div#addRow").remove()}, removeTime);
        }
        catch {}
        finally {
            firstAddShow = true;
        }
    }

    static delAnimation(tagElement) {
        try {
            tagElement.classList.remove("newRow");
        }
        catch {
            return;
        }
    }

    static addRow() {
        try {
            const nameCountry = document.querySelector("div#addRow>div.clientAddRow>input#nameCountry");
            const errMes = document.querySelector("div#addRow>div.errAddShow");
            const errMesText = errMes.getElementsByTagName('div')[0].querySelector("span#textErr");
            const strongErr = errMes.getElementsByTagName('div')[0].querySelector("strong.mesTitle");

            let table = Table.get();
            errMes.style.display = "flex";
            for (let i = 0; i < table.length; i++) {
                if (String(nameCountry.value).toLowerCase() === String(table[i]['Country']).toLowerCase()) {
                    nameCountry.value = "";
                    errMesText.innerHTML = "The table already has such a country, enter another";
                    return;
                }
                else if (String(nameCountry.value) == "") {
                    errMesText.innerHTML = "Country name mustn't be EMPTY!";
                    return;
                }
            }

            errMes.getElementsByTagName('div')[0].setAttribute("class", "success");
            strongErr.innerHTML = "Success";
            errMesText.innerHTML = "Row added";

            const newCountry = SystemFunctions.toNormalString(String(nameCountry.value));
            let tbody = document.querySelector("tbody#dataTable");
            if (tbody == undefined) {
                const main = document.querySelector("main");
                main.querySelector("span.notFound").remove();
                main.innerHTML += 
                `<table id="table" class="table">
                    <thead>
                        <th style="display: flex; align-items: center;">
                            <span>Country</span>
                            <i onclick="ClientTable.sortTable()" class="material-icons sort">keyboard_arrow_down</i>
                        </th>
                        <th style="width: 70px;"></th>
                    </thead>
                    <tbody id="dataTable"></tbody>
                </table>`;
            }
            
            tbody = document.querySelector("tbody#dataTable");
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                try {
                    const tagElement = Element.getByCountry(String(newCountry));
                    tbody.innerHTML = 
                    `   <tr class="newRow" onmouseover="ClientAddRow.delAnimation(this)">
                            <td class="country" id="${tagElement['id']}" onclick="getRowInfo(this)">${tagElement['Country']}</td>
                            <td class="settings">
                                <i onclick="ClientDeleteRow.deleteRow(this)" id="${tagElement['id']}" class="material-icons delete">delete</i>
                            </td>
                        </tr>
                    ` + tbody.innerHTML;
                }
                catch {
                    return undefined;
                }
            }
            xmlhttp.open("GET", "DATABASE/addRow.php?newCountry=" + newCountry, false);
            xmlhttp.send();
            ClientAddRow.closeFormAddRow(true);
            table = Table.get();
        }
        catch {
            return undefined;
        }
    }

    static showMesRowAdd() {
        if (!firstAddShow)
            return;

        try {
            firstAddShow = false;
            const messages = document.querySelector("section#messages");

            messages.innerHTML =
            `<div class="message info addRow" id="addRow" style="animation: showMessage 0.8s;">
                <div class="clientAddRow">
                    <strong class="mesTitle add">Country</strong>
                    <input type="text" id="nameCountry" class="inputInfo">
                    <button onclick="ClientAddRow.addRow()" class="btnMes">Add</button>
                </div>
                <div class="errAddShow">
                    <div class="error" id="errAdd">
                        <strong class="mesTitle" style="display: inline">Error</strong>
                        <span id="textErr"></span>
                    </div>
                    <button class="btnMes close" onclick="ClientAddRow.closeFormAddRow()">Close</button>
                </div>
            </div>` + messages.innerHTML;

            if (window.screen.width < 450) {
                const countryInput = document.querySelector("input#nameCountry");
                countryInput.style.width = window.screen.width - 36 + "px";
            }
        }
        catch {
            return;
        }
    }
}

class ClientDeleteRow {
    static closeFormDeleteRow() {
        const messages = document.querySelector("section#messages");
        messages.querySelector("div#deleteRow").style.animation = "closeMessage 0.8s";
        setTimeout(() => {messages.querySelector("div#deleteRow").remove()}, 600);
    }

    static yesDeleteRow(id) {
        try {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {};
            xmlhttp.open("POST", "DATABASE/deleteRow.php?id=" + String(id));
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
            
            ClientDeleteRow.closeFormDeleteRow();
            setTimeout(()=>{ClientTable.loadTable()}, 1200);
        }
        catch {
            return undefined;
        }
        finally {
            delRowShow = false;
        }
    }

    static noDeleteRow() {
        ClientDeleteRow.closeFormDeleteRow();
        delRowShow = false;
    }

    static getWarningDelete(tagElement, text, funcNameYes, funcNameNo) {
        return `<div class="message warning" id="deleteRow">
            <div class="textmes">
                <strong class="mesTitle">Warning</strong>
                <span>${text}</span>
            </div>
            <div class="btnWarning">
                <button class="btnMes" onclick="${funcNameYes}(${tagElement.id})">Yes</button>
                <button class="btnMes no" onclick="${funcNameNo}()">No</button>
            </div>
        </div>`;
    }

    static deleteRow(tagElement) {
        if (delRowShow)
            return;
        else
            delRowShow = true;

        try {
            const messages = document.querySelector("section#messages");
            messages.innerHTML = ClientDeleteRow.getWarningDelete(
                tagElement, 
                "Are you sure delete this row?", 
                "ClientDeleteRow.yesDeleteRow", 
                "ClientDeleteRow.noDeleteRow") + messages.innerHTML;
            messages.querySelector("section#messages>div#deleteRow").style.animation = "showMessage 0.8s";
        }
        catch {
            return undefined;
        }
    }
}