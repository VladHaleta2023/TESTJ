class SystemFunctions {
    static toNormalString(countryName) {
        let result = "";
        for (let i = 0; i < countryName.length; i++) {
            if (i == 0)
                result += countryName[i].toUpperCase();
            else
                result += countryName[i].toLowerCase();
        }

        return result;
    }
}

class Element {
    static getBySearch(textSearch) {
        let element = undefined;
        try {
            textSearch = String(textSearch);
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);
                try {
                    element = result['table'];
                }
                catch {
                    element = null; 
                }
            }

            xmlhttp.open("POST", "DATABASE/getElement.php?textSearch=" + String(textSearch), false);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
        }
        finally {
            return element;
        }
    }

    static getById(id) {
        let element = undefined;
        try {
            id = String(id);
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);

                try {
                    element = result['table'][0];
                }
                catch {
                    element = null; 
                }
            }

            xmlhttp.open("POST", "DATABASE/getElementById.php?id=" + String(id), false);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
        }
        finally {
            return element;
        }
    }

    static getByCountry(countryName) {
        let element = undefined;
        try {
            countryName = String(countryName);
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);

                try {
                    element = result['table'][0];
                }
                catch {
                    element = null; 
                }
            }

            xmlhttp.open("POST", "DATABASE/getElementByCountry.php?countryName=" + String(countryName), false);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
        }
        finally {
            return element;
        }
    }
}

class Message {
    constructor (type, title, text) {
        if (type !== "info" &&
            type !== "error" &&
            type !== "warning" &&
            type !== "success") {
            this.type = undefined;
        }
        else
            this.type = type;
        this.title = title;
        this.text = text;
    }

    static close(tagElement) {
        try {
            tagElement.parentElement.parentElement.style.animation = "closeMessage 0.8s";
            setTimeout(() => {tagElement.parentElement.parentElement.remove();}, 700);
        }
        catch {
            return undefined;
        }
    }

    static write(type, title, text) {
        if (type !== "info" &&
            type !== "error" &&
            type !== "warning" &&
            type !== "success") {
            return "Error type message"; 
        }
        if (text === undefined || title === undefined || 
            text === null || title === null)
            return "Critical Error: I don't write the message";
        try {
            title = String(title);
            text = String(text);
            const messages = document.querySelector("section#messages");
            (title != "") ? title = SystemFunctions.toNormalString(title) : title = SystemFunctions.toNormalString(type);
            messages.innerHTML = 
            `<div class="message ${type}" style="animation: showMessage 0.8s;">
                <div class="textmes">
                    <span><strong class="mesTitle message">${title}</strong>${text}</span>
                </div>
                <div class="btnWarning">
                    <button class="btnMes ${type}" onclick="Message.close(this)">Close</button>
                </div>
            </div>` + messages.innerHTML;
        }
        catch {
            return "Critical Error: I don't write the message";
        }
    }

    write() {
        if (this.type != "info" &&
            this.type != "error" &&
            this.type != "warning" &&
            this.type != "success") {
            return "Error type message";
        }  
        if (this.text === undefined || this.title === undefined || 
            this.text === null || this.title === null)
            return "Critical Error: I don't write the message";
        try {
            const messages = document.querySelector("section#messages");
            (this.title != "") ? this.title = SystemFunctions.toNormalString(this.title) : this.title = SystemFunctions.toNormalString(this.type);
            messages.innerHTML = 
            `<div class="message ${this.type}" style="animation: showMessage 0.8s;">
                <div class="textmes">
                    <span><strong class="mesTitle message">${this.title}</strong>${this.text}</span>
                </div>
                <div class="btnWarning">
                    <button class="btnMes ${this.type}" onclick="Message.close(this)">Close</button>
                </div>
            </div>` + messages.innerHTML;
        }
        catch {
            return "Critical Error: I don't write the message";
        }
    }
}

class Table {
    static get() {
        let table = [];
        try {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const json = JSON.parse(this.responseText);
                const result = json['table'];
                if (result === undefined)
                    return;
                else
                    for (let i = 0; i < result.length; i++)
                        table.push(result[i]);
            }
            xmlhttp.open("GET", "DATABASE/getResult.php", false);
            xmlhttp.send();
            return table;
        }
        catch {
            return [];
        }
    }

    static getResult() {
        let result = [];
        try {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const json = JSON.parse(this.responseText);
                result = json;
            }
            xmlhttp.open("GET", "DATABASE/getResult.php", false);
            xmlhttp.send();
            return result;
        }
        catch {
        }
    }
}

class Server {
    static level = 1;

    static getResult() {
        let result = [];
        try {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const json = JSON.parse(this.responseText);
                result = json;
            }

            let path = "";
            for (let i = 0; i < Server.level; i++)
                path += "../";

            xmlhttp.open("GET", String(path) + "Table/DATABASE/getResult.php", false);
            xmlhttp.send();
            return result;
        }
        catch {
            return result;
        }
    }

    static getTable() {
        let table = [];
        try {
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const json = JSON.parse(this.responseText);
                const result = json['table'];
                if (result === undefined)
                    return;
                else
                    for (let i = 0; i < result.length; i++)
                        table.push(result[i]);
            }

            let path = "";
            for (let i = 0; i < Server.level; i++)
                path += "../";

            xmlhttp.open("GET", String(path) + "Table/DATABASE/getResult.php", false);
            xmlhttp.send();
            return table;
        }
        catch {
            return [];
        }
    }

    static getElementByCountry(country) {
        let element = undefined; 
        try {
            country = String(country);
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);

                try {
                    element = result['table'][0];
                }
                catch {
                    element = null; 
                }
            }

            let path = "";
            for (let i = 0; i < Server.level; i++)
                path += "../";

            xmlhttp.open("POST", String(path) + "Table/DATABASE/getElementByCountry.php?countryName=" + String(country), false);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
        }
        finally {
            return element;
        }
    }

    static getElementBySearch(searchText) {
        let element = undefined;
        try {
            searchText = String(searchText);
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);
                try {
                    element = result['table'];
                }
                catch {
                    element = null; 
                }
            }

            let path = "";
            for (let i = 0; i < Server.level; i++)
                path += "../";

            xmlhttp.open("POST", String(path) + "Table/DATABASE/getElement.php?textSearch=" + String(searchText), false);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
        }
        finally {
            return element;
        }
    }

    static getElementById(id) {
        let element = undefined;
        try {
            id = String(id);
            const xmlhttp = new XMLHttpRequest();
            xmlhttp.onload = function() {
                const result = JSON.parse(this.responseText);

                try {
                    element = result['table'][0];
                }
                catch {
                    element = null; 
                }
            }

            let path = "";
            for (let i = 0; i < Server.level; i++)
                path += "../";

            xmlhttp.open("POST", String(path) + "Table/DATABASE/getElementById.php?id=" + String(id), false);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
            xmlhttp.send();
        }
        finally {
            return element;
        }
    }
}