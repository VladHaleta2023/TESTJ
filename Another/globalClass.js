class PrintInfo {
    constructor (filenameJSON = "globalClass") {
        this.filenameJSON = filenameJSON;
    }

    OnConsole() {
        try {
            fetch('' + String(this.filenameJSON) + '.json')
                .then(res => res.json())
                .then(data => {
                    console.log(data);
            });
        }
        catch {
            return;
        }
    }

    OnDOMElement(DOMElement) {
        try {
            fetch(String(this.filenameJSON) + '.json')
                .then(res => res.json())
                .then(data => {
                    DOMElement.innerHTML = data;
            });
        }
        catch {
            return;
        }
    }

    static sendEmailDevInfo(email) {
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.body.innerHTML += xmlhttp.responseText;
        }
        xmlhttp.open("GET", "globalClass.php?email=" + String(email));
        xmlhttp.send();
    }

    sendJSON_TO_PHP() {
        try {
            fetch(String(this.filenameJSON) + ".json")
                .then((response) => response.json())
                .then((data) => {
                    const jsonString = JSON.stringify(data);
                    const xmlhttp = new XMLHttpRequest();
                    xmlhttp.onload = function() {
                        console.log(xmlhttp.responseText);
                    }
                    xmlhttp.open("POST", "globalClass.php");
                    xmlhttp.setRequestHeader("Content-Type", "application/json");
                    xmlhttp.send(String(jsonString));
                });
        } 
        catch {
            console.log("Error");
            return;
        }
    }
}