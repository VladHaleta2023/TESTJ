<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <style>
        * {
            padding: 0px;
            margin: 0px;
            box-sizing: border-box;
        }

        span::selection {
            background-color: transparent;
        }

        img::selection {
            background-color: transparent;
        }

        p::selection {
            background-color: transparent;
        }

        h1::selection {
            background-color: blueviolet;
        }

        a::selection {
            background-color: plum;
            color: white;
        }

        .text::selection {
            background-color: cornflowerblue;
        }

        body {
            display: flex; 
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 32px 0px;
            margin: 0px;
        }

        .function {
            color: #271ccb; 
            font-size: 26px; 
            width: 108px;
        }

        .nameFunc {
            width: 300px
        }

        .class {
            font-size: 26px; 
            color: green; 
            font-weight: bold;
        }

        .printInfo {
            font-size: 26px; 
            color: #c3cd0c; 
            width: 98px;
        }

        .text {
            color: rgb(0, 0, 0); 
            margin-bottom: 32px;
            font-size: 24px; 
            min-width: 200px; 
            max-width: 600px;
        }

        header {
            width: 800px;
            text-align: center;
            background: linear-gradient(90deg, rgb(19, 70, 137) 15%, rgba(160,28,203,1) 85%); 
            padding: 12px;
        }

        main {
            background-color: #c6faf9; 
            display: flex; 
            flex-direction: column; 
            align-items: center; 
            justify-content: center;
            text-align: center; 
            padding: 32px 16px;
            width: 800px;
        }

        footer {
            display: flex; 
            justify-content: center; 
            align-items: center; 
            width: 800px; 
            margin: 0px;
            text-align: center;
            font-variant: small-caps;
            padding: 24px;
            background: linear-gradient(45deg, rgba(40,42,43,1) 46%, rgba(0,0,0,1) 75%);
            color: rgb(30, 224, 221);
            font-size: 40px;
        }

        img {
            border-radius: 16px;
            cursor: pointer;
        }

        h1 {
            font-size: 48px;
            color: rgb(255, 255, 255);
            margin: 12px;
        }

        a {
            cursor: pointer; 
            background-color: #c6faf9; 
            text-decoration: none; 
            color: #271ccb;
            border: 0px; 
            color: (0, 0, 0); 
            font-size: 28px;
        }

        a:hover {
            transition: 1.1s;
            font-size: 28.5px;
            color: blue;
        }

        @media screen and (min-width: 1300px){
            header {
                width: 1200px;
            }

            main {
                width: 1200px;
            }

            footer {
                width: 1200px; 
                font-size: 40px;
            }

            img {
                max-width: 1100px;
                max-height: 1080px;
            }
        }

        @media screen and (max-width: 1300px){
            header {
                width: 1200px;
            }

            main {
                width: 1200px;
            }

            footer {
                width: 1200px; 
                font-size: 40px;
            }

            img {
                max-width: 1100px;
                max-height: 1080px;
            }
        }

        @media screen and (max-width: 1200px){
            header {
                width: 1100px;
            }

            main {
                width: 1100px;
            }

            footer {
                width: 1100px; 
                font-size: 40px;
            }

            img {
                max-width: 1000px;
                max-height: 980px;
            }
        }

        @media screen and (max-width: 1100px){
            header {
                width: 1000px;
            }

            main {
                width: 1000px;
            }

            footer {
                width: 1000px; 
                font-size: 40px;
            }

            img {
                max-width: 900px;
                max-height: 880px;
            }
        }

        @media screen and (max-width: 1060px){
            header {
                width: 900px;
            }

            main {
                width: 900px;
            }

            footer {
                width: 900px; 
                font-size: 40px;
            }

            img {
                max-width: 800px;
                max-height: 780px;
            }
        }

        @media screen and (max-width: 960px){
            header {
                width: 800px;
            }

            main {
                width: 800px;
            }

            footer {
                width: 800px; 
                font-size: 40px;
            }

            img {
                max-width: 700px;
                max-height: 680px;
            }
        }

        @media screen and (max-width: 860px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            header {
                width: 630px;
            }

            main {
                width: 630px;
                padding: 32px;
            }

            footer {
                width: 630px; 
                font-size: 32px;
            }

            img {
                max-width: 600px;
                max-height: 500px;
            }
        }

        @media screen and (max-width: 700px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            h1 {
                font-size: 40px;
            }

            header {
                width: 530px;
            }

            main {
                width: 530px;
                padding: 48px;
            }

            footer {
                width: 530px; 
                font-size: 32px;
            }

            img {
                max-width: 500px;
                max-height: 480px;
            }
        }

        @media screen and (max-width: 620px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            img {
                max-width: 400px;
                max-height: 380px;
            }

            h1 {
                font-size: 32px;
            }

            header {
                width: 430px;
            }

            main {
                width: 430px;
                padding: 48px;
            }

            footer {
                width: 430px; 
                font-size: 32px;
            }

            .function {
                font-size: 20px;
            }

            .class {
                font-size: 16px;
            }

            .printInfo {
                font-size: 20px;
            }

            .nameFunc {
                width: 200px;
            }
        }

        @media screen and (max-width: 500px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            img {
                max-width: 300px;
                max-height: 280px;
            }

            h1 {
                font-size: 24px;
            }

            header {
                width: 330px;
            }

            main {
                width: 330px;
                padding: 48px;
            }

            footer {
                width: 330px; 
                font-size: 24px;
            }

            p {
                width: 320px;
            }

            .function {
                width: 80px;
            }
        }

        @media screen and (max-width: 370px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            h1 {
                font-size: 20px;
            }

            header {
                width: 280px;
            }

            main {
                width: 280px;
                padding: 48px;
            }

            footer {
                width: 280px; 
                font-size: 20px;
            }

            img {
                max-width: 260px;
                max-height: 240px;
            }

            .function {
                font-size: 18px;
            }

            .class {
                font-size: 14px;
            }

            .printInfo {
                font-size: 18px;
            }

            p {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 250px;
            }
        }

        @media screen and (max-width: 320px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            img {
                max-width: 200px;
                max-height: 180px;
            }

            h1 {
                font-size: 20px;
            }

            header {
                width: 230px;
            }

            main {
                width: 230px;
            }

            .text {
                padding: 0px 24px;
            }

            p {
                display: flex;
                flex-direction: column;
            }

            footer {
                width: 230px; 
                padding: 6px;
                font-size: 16px;
            }
        }

        @media screen and (max-width: 280px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            img {
                max-width: 180px;
                max-height: 160px;
            }

            h1 {
                font-size: 16px;
            }

            header {
                width: 220px;
            }

            main {
                width: 220px;
            }

            footer {
                width: 220px; 
                padding: 6px;
                font-size: 12px;
            }
        }

        @media screen and (max-width: 270px) {
            body {
                display: flex; 
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0px; 
                margin: 0px;
            }

            img {
                max-width: 150px;
                max-height: 130px;
            }

            h1 {
                font-size: 16px;
            }

            header {
                width: 180px;
            }

            main {
                width: 180px;
            }

            footer {
                width: 180px; 
                padding: 6px;
                font-size: 12px;
            }

            .function {
                font-size: 14px;
            }

            .class {
                font-size: 14px;
            }

            .printInfo {
                font-size: 14px;
            }
        }
    </style>
    <body> 
        <header>
            <h1>Developer Information</h1>
        </header>
        <main>
            <div class="text">In order to use the code and classes, you need 
            to connect the js and css file to the html 
            page and call in html file:</div>
            <p style="display: flex; justify-content: center; align-items: center; margin-bottom: 32px;">
                <span class="function">function</span>
                <span class="nameFunc">
                    <span class="class">[JS FileName].</span>
                    <span class="printInfo">printInfo</span>
                    <span style="font-weight: bold; font-size: 22px;">()</span>
                </span>
            </p> 
            <div class="text">This Function print JSON Information to console of google 
                <br>
                <br>
                <a href="https://javascript.info/debugging-chrome" target="_blank">Click F12 by show this information</a>
            </div>
            <img src="ExampleDev.png" alt="Example">
        </main>
        <footer>
            <img src="Company.ico" alt="CompanyImg" style="width: 50px; height: 50px;">
            <p style="margin: 0px 16px; padding-bottom: 6px;">haleta company</p>
        </footer>
    </body>
</html>