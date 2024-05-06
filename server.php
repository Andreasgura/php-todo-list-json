<?php 

$dataJson = file_get_contents("js/data.json");

$listPhp = json_decode($dataJson, true);

if (isset($_POST['text'])) {
    $newLi = [
        "id" => $listPhp[count($listPhp) - 1]['id'] + 1,
        "text" => $_POST['text'],
        "done" => false
    ];
    $listPhp[] = $newLi;
    $dataJson = json_encode($listPhp, JSON_PRETTY_PRINT);
    file_put_contents("js/data.json", $dataJson);
}


header("Content-Type: application/json");
echo $dataJson;