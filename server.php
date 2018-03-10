<?php

if (isset($_GET["search"])) {
    $main = file_get_contents("https://api.punkapi.com/v2/beers");
    $data = json_decode($main, true);
    $counter=0;

    $criteria = $_GET["search"];
    $result = array();


    foreach ($data as $item) {


        if (stristr($item["name"], $criteria) !== false) {
            $result[] = $item["name"];
            $counter++;
            if($counter===5){
                break;
            }
        }
    }
    echo json_encode($result);
}

if (isset($_GET["requestInfo"])) {
    $main = file_get_contents("https://api.punkapi.com/v2/beers");
    $data = json_decode($main, true);


    $criteria = trim($_GET["requestInfo"], " ");
    $result = array();
    foreach ($data as $item) {


        if ($item["name"] === $criteria) {
            $result["Name"] = $item["name"];
            $result["Tagline"] = $item["tagline"];
            $result["First Brewed"] = $item["first_brewed"];
            $result["image"]=$item["image_url"];
            $result["Alc"]=$item["abv"];
            break;
        }
    }
    echo json_encode($result);

}


?>