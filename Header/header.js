class LinkHeader {
    constructor (func, text) {
        this.func = func;
        this.text = text;
    }
}

class Header {
    constructor (arrLinks) {
        function create() {
            try {
                let result = `
    <header id="header">
        <nav>
            <a href="https://github.com/VladHaleta2023" target="_blank">
                <div class="symbolCompany">
                    <img class="imgCompany" src="../CompanyImg.png" alt="CompanyImg">
                    <span class="textCompany">vlh data company</span>
                </div>
            </a>
            <div class="phone-Content">
                <button class="phone-Btn" onclick="Header.clickBtnPhone(this)">
                    <i class="material-icons" style="font-size: 42px; color: white; padding-top: 6px;">dehaze</i>
                </button>
                <ul>
                `;
    
                if (arrLinks == null || arrLinks.length == 0) {
                    result += `    <li onclick="null"></li>
                `; 
                    result += `</ul>`; 
                }
                else {
                    for (let i = 0; i < arrLinks.length; i++)
                        result += `    <li onclick="${arrLinks[i].func}">${arrLinks[i].text}</li>
                `;
                    result += `</ul>`;
                }
    
                result += `            
            </div>
        </nav>
    </header>
                `;
    
                return String(result);
            }
            catch {
                return "";
            }
        }
        this.result = create();
    }

    static getSysHeaderLinks(print = false) {
        const arrLinks = [
            new LinkHeader("gotoHomePage()", 
`<i class="material-icons header-icon opacityAnimation">home</i>
<span class="header-span">Home</span>`),
            new LinkHeader("gotoTablePage()", 
`<i class="material-icons header-icon roundAnimation">settings</i>
<span class="header-span">Table</span>`),
            new LinkHeader("gotoGenerationPage()", 
`<i class="material-icons header-icon roundAnimation">loop</i>
<span class="header-span">Generation</span>`),
            new LinkHeader("gotoTestPage()",
`<i class="material-icons header-icon opacityAnimation">live_help textsms</i>
<span class="header-span">Test</span>`)
        ];

        if (print)
            console.log(arrLinks);

        return arrLinks;
    }

    add() {
        document.body.innerHTML += this.result;
    }

    remove() {
        document.getElementById("header").remove();
    }

    static clickBtnPhone(element) {
        const iconPhoneContent = element.parentNode.querySelector("button.phone-Btn").querySelector("i.material-icons");
        const ul = element.parentNode.querySelector("ul");
        ul.style.flexDirection = "column";
        if (iconPhoneContent.innerHTML == "dehaze") {
            iconPhoneContent.innerHTML = "close";
            ul.style.display = "flex";
            if (document.body.width > 700) {
                ul.style.animation = "iPadShowContent";
                ul.style.animationDuration = "0.8s";
            }
            else {
                ul.style.animation = "phoneShowContent";
                ul.style.animationDuration = "0.8s";
            }
        }
        else {
            iconPhoneContent.innerHTML = "dehaze";
            if (document.body.width > 700) {
                ul.style.animation = "iPadCloseContent";
                ul.style.animationDuration = "0.8s";
            }
            else {
                ul.style.animation = "phoneCloseContent";
                ul.style.animationDuration = "0.8s";
            }
            setTimeout(() => { ul.style.display = "none"; }, 500);
        }
    }
}

class Info {
    static print(printStaticMethod = true, printConnectFiles = true, printExampleHTML = true) {
        console.log("System Links of Header Class:");
        const linkHeader = Header.getSysHeaderLinks(true);
        const header = new Header();
        console.log("Header Class:");
        console.log(header);
        if (printStaticMethod)
            console.log(`Static method of Header Class: getSysHeaderLinks()`);
        if (printConnectFiles)
            console.log(`Connect files:
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="header.css">
<link rel="stylesheet" href="icons.css">`);
        if (printExampleHTML)
            console.log(`Example HTML:
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="header.css">
    <link rel="stylesheet" href="icons.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>TestJ</title>
</head>
<body>
    <script src="header.js"></script>
    <script>
        let sysHeaderLinks = Header.getSysHeaderLinks();
        let header = new Header();
        header = new Header(sysHeaderLinks);
        header.add();
        Info.print();
    </script>
</body>
</html>`);
    }
}