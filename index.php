<?php


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Document</title>
</head>
<body>
<div id="container">
    <h1>What is the beer you want to drink?</h1>

    <input type="text" oninput="showInfo(this)" placeholder="Search :)">
    <div id="showInfo" style="visibility: hidden"></div>
    <div id="info" style="visibility: hidden"></div>
</div>
</body>

<script>
    function showInfo(input) {
        var div = document.getElementById("showInfo");
        div.innerHTML = "";
        if (input.value === "") {
            div.innerHTML = "";
            div.style.visibility = "hidden";
            return;

        }
        var request = new XMLHttpRequest();
        request.open("get", "server.php?search=" + input.value);
        request.onreadystatechange = function (ev) {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var field = JSON.parse(this.responseText);
                    var ul = document.createElement("ul");
                    for (var item in field) {
                        var li = document.createElement("li");

                        li.innerHTML = field[item];//.link("index.php?name="+ field[item]+"#");

                        ul.appendChild(li);

                        li.onclick = function () {

                            var divInfo = document.getElementById("info");
                            divInfo.innerHTML = "";
                            var clicked = this.innerHTML;
                            var requestInfo = new XMLHttpRequest();
                            requestInfo.open("get", "server.php?requestInfo=" + clicked);
                            requestInfo.onreadystatechange = function () {
                                if (requestInfo.readyState === 4) {
                                    if (requestInfo.status === 200) {
                                        var resultInfo = JSON.parse(this.responseText);
                                        var ulInfo = document.createElement("ul");
                                        for (var itemInfo in resultInfo) {
                                            var liInfo = document.createElement("li");
                                            if(itemInfo==="image"){
                                                liInfo.innerHTML="<img src="+ resultInfo[itemInfo] +" >";
                                            }else{
                                            liInfo.innerHTML = itemInfo + " : " + resultInfo[itemInfo];
                                            }
                                            ulInfo.appendChild(liInfo);
                                        }

                                        divInfo.appendChild(ulInfo);
                                        divInfo.style.visibility = "visible";
                                    }
                                }
                            }
                            requestInfo.send();


                        }


                    }

                    div.appendChild(ul);
                    div.style.visibility = "visible";

                }
            }

        }
        request.send();


    }

    function displayInfo(item) {
        document.getElementById("info").style.visibility = "visible";
        div = document.getElementById("info");
        div.innerHTML = item.value;

    }


</script>


</html>
